<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;
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
        if ($this->request->is(['post','put'])) {
            $user = $this->Auth->user();
            $input = $this->request->data;
            if(isset($input['inspection']['check']))
                $application->status = Configure::read('application_status')['Investigating'];
            else
                $application->status = Configure::read('application_status')['Approved'];
            if($this->Applications->save($application)){
                //insert hearing
                $data_hearing['office_id'] = $application['office_id'];
                $data_hearing['application_id'] = $id;
                $data_hearing['hearing_time'] = strtotime($input['hearing']['hearing_time']);
                $data_hearing['location'] = $input['hearing']['location'];
                $data_hearing['status'] = 1;
                $data_hearing['create_by'] = $user['id'];
                $data_hearing['create_time'] = time();
                $hearingTbl = TableRegistry::get('hearings');
                $hearingEntity = $hearingTbl->newEntity();
                $hearingEntity = $hearingTbl->patchEntity($hearingEntity, $data_hearing);
                if ($hearingTbl->save($hearingEntity)) {
                    $inspectionTbl = TableRegistry::get('inspections');
                    $inspectionEntity = $inspectionTbl->newEntity();
                    $data_inspection['office_id'] = $application['office_id'];
                    $data_inspection['application_id'] = $id;
                    $data_inspection['inspection_date'] = strtotime($input['inspection']['inspection_date']);
                    $inspectionEntity = $hearingTbl->patchEntity($inspectionEntity, $data_inspection);
                    if (!$inspectionTbl->save($inspectionEntity)) {
                    return false;
                    }
                }
            }
            else
                return false;
            echo '<pre>';
            print_r($this->request->data);
            echo '</pre>';
            die;
            $receiveApplication = $this->ReceiveApplications->patchEntity($receiveApplication, $this->request->data);
            if ($this->ReceiveApplications->save($receiveApplication)) {
                $this->Flash->success(__('The receive application has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The receive application could not be saved. Please, try again.'));
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
            echo '<pre>';
            print_r($this->request->data);
            echo '</pre>';
            die;
            $receiveApplication = $this->ReceiveApplications->patchEntity($receiveApplication, $this->request->data);
            if ($this->ReceiveApplications->save($receiveApplication)) {
                $this->Flash->success(__('The receive application has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The receive application could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('receiveApplication'));
        $this->set('_serialize', ['receiveApplication']);
    }
    public function ajax($action=''){

    }
}
