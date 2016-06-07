<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;
use Cake\Utility\Security;

/**
 * ReceiveApplications Controller
 *
 * @property \App\Model\Table\ApplicationsTable $Applications
 */
class ReceiveApplicationsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Applications');
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $user = $this->Auth->user();
        $application_status = Configure::read('application_status');
        $applications = $this->Applications->find();
        $applications->where([
            'Applications.status'=>$application_status['Pending'],
            'Applications.division_id'=>$user['division_id'],
            'Applications.district_id'=>$user['district_id']
        ]);
        $applications->contain(['ParentApplications','Appellants','Upazilas','Moujas']);
        $applications = $this->paginate($applications);
        $this->set(compact('applications'));
        $this->set('_serialize', ['applications']);
    }

    /**
     * View method
     *
     * @param string|null $id Receive Application id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $receiveApplication = $this->ReceiveApplications->get($id, [
            'contain' => []
        ]);

        $this->set('receiveApplication', $receiveApplication);
        $this->set('_serialize', ['receiveApplication']);
    }

    /**
     * Receive application method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function receive($pram=null)
    {
        $pram = $this->Common->hashids()->decode($pram);
        if(empty($pram))
        {
            $this->Flash->error(__('Invalid Url'));
            return $this->redirect(['action' => 'index']);
        }
        $id = $pram[0];// here id is first pram
        $application = $this->Applications->get($id,
            [
                'contain'=>['ParentApplications','Appellants','Defendants','ApplicationFiles','Lawyers','Upazilas','Moujas']
            ]
        );
        if($application->status != Configure::read('application_status')['Pending']){
            $this->Flash->warning('The application already received/reject');
            return $this->redirect(['action' => 'index']);
        }
        if ($this->request->is(['post','put'])) {
            try {
                $user = $this->Auth->user();
                $input = $this->request->data;
                $conn = ConnectionManager::get('default');
                $conn->transactional(function () use ($id,$application, $user, $input) {
                    //application data
                    if(isset($input['inspection']['check']) && $input['inspection']['check'])
                        $application->status = Configure::read('application_status')['Investigating'];
                    else
                        $application->status = Configure::read('application_status')['Approved'];

                    $application->case_number = $input['case_number'];
                    $application->case_receive_time = time();
                    $application->case_receive_by = $user['id'];
                    $application->update_time = time();
                    $application->update_by = $user['id'];
                    if($this->Applications->save($application)){
                        //insert hearing
                        $hearingTbl = TableRegistry::get('hearings');
                        $hearingEntity = $hearingTbl->newEntity();
                        $data_hearing['office_id'] = $application['office_id'];
                        $data_hearing['application_id'] = $id;
                        $data_hearing['hearing_time'] = strtotime($input['hearing']['hearing_time']);
                        $data_hearing['location'] = $input['hearing']['location'];
                        $data_hearing['status'] = 1;
                        $data_hearing['create_by'] = $user['id'];
                        $data_hearing['create_time'] = time();
                        $hearingEntity = $hearingTbl->patchEntity($hearingEntity, $data_hearing);
                        if ($hearingTbl->save($hearingEntity)) {
                            //insert inspection data
                            if(isset($input['inspection']['check']) && $input['inspection']['check']){
                                $inspectionTbl = TableRegistry::get('inspections');
                                $inspectionEntity = $inspectionTbl->newEntity();
                                $data_inspection['office_id'] = $application['office_id'];
                                $data_inspection['application_id'] = $id;
                                $data_inspection['inspection_date'] = strtotime($input['inspection']['inspection_date']);
                                $data_inspection['create_by'] = $user['id'];
                                $data_inspection['create_time'] = time();
                                $data_inspection['status'] = Configure::read('inspections_status')['pending'];
                                $inspectionEntity = $hearingTbl->patchEntity($inspectionEntity, $data_inspection);
                                if (!$inspectionTbl->save($inspectionEntity)) {
                                    return false;
                                }
                            }
                            // application remarks
                            $remarksTbl = TableRegistry::get('application_remarks');
                            $remarksEntity = $remarksTbl->newEntity();
                            $remarksEntity->application_id = $id;
                            $remarksEntity->remarks = $input['remarks'];
                            $remarksEntity->application_status = $application->status;
                            $remarksEntity->user_id = $user['id'];
                            $remarksEntity->create_time = time();
                            if (!$remarksTbl->save($remarksEntity)) {
                                return false;
                            }
                            //TODO::send message and mail to user
                        }
                        else
                            return false;
                    }
                    else
                        return false;
                    //redirect to index
                    $this->Flash->success('Application Received Successfully');
                    return $this->redirect(['action' => 'index']);
                });
            }
            catch (\Exception $e) {
                $this->Flash->error('Application could not be Received. Please, try again.');
            }
        }
        $this->set(compact('application'));
        $this->set('_serialize', ['application']);
    }

    /**
     * Reject method
     *
     * @param string|null $id Receive Application id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function reject($pram = null)
    {
        $pram = $this->Common->hashids()->decode($pram);
        if(empty($pram))
        {
            $this->Flash->error(__('Invalid Url'));
            return $this->redirect(['action' => 'index']);
        }
        $id = $pram[0];// here id is first pram
        if ($this->request->is(['patch', 'post', 'put'])) {
            $input = $this->request->data;
            $user = $this->Auth->user();
            $application = $this->Applications->get($id);
            $application->status =  Configure::read('application_status')['Reject'];
            if($this->Applications->save($application)){
                // application remarks
                $remarksTbl = TableRegistry::get('application_remarks');
                $remarksEntity = $remarksTbl->newEntity();
                $remarksEntity->application_id = $id;
                $remarksEntity->remarks = $input['remarks'];
                $remarksEntity->application_status = $application->status;
                $remarksEntity->user_id = $user['id'];
                $remarksEntity->create_time = time();
                $remarksTbl->save($remarksEntity);
                $this->Flash->success(__('The application Reject successfully'));
            }
            else{
                $this->Flash->error(__('The application could not be reject. Please try again.'));
            }
        }
        return $this->redirect(['action' => 'index']);
    }
    public function ajax($action=''){

    }
}
