<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;

/**
 * SubmitInspectionResults Controller
 *
 * @property \App\Model\Table\InspectionResultsTable $InspectionResults
 */
class SubmitInspectionResultsController extends AppController
{
    public $paginate = [
        'limit'=>10
    ];
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Inspections');
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $user = $this->Auth->user();
        $inspections = $this->Inspections->find();
        $inspections->where([
            'Inspections.status'=>Configure::read('inspections_status')['pending'],
            'Inspections.office_id'=>$user['office_id']
        ]);
        $inspections->contain(['Applications','Applications.Appellants','Applications.Moujas']);
        $inspections = $this->paginate($inspections);
        $this->set(compact('inspections'));
        $this->set('_serialize', ['inspections']);
    }

    /**
     * View method
     *
     * @param string|null $id Submit Inspection Result id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function submit($pram = null)
    {
        $pram_array = $this->Common->hashids()->decode($pram);
        if(empty($pram))
        {
            $this->Flash->error(__('Invalid Url'));
            return $this->redirect(['action' => 'index']);
        }
        $id = $pram_array[0];// here id is first pram
        $inspections = $this->Inspections->get($id,
            [
                'contain'=>['Applications','Applications.Appellants','Applications.Defendants','Applications.ApplicationFiles','Applications.Lawyers','Applications.ApplicationRemarks','Applications.ApplicationRemarks.Users']
            ]
        );
        if($inspections->status != Configure::read('inspections_status')['pending']){
            $this->Flash->warning('Some went wrong.');
            return $this->redirect(['action' => 'index']);
        }
        if ($this->request->is(['post','put'])) {
            try {
                $user = $this->Auth->user();
                $input = $this->request->data;
                $conn = ConnectionManager::get('default');
                $conn->transactional(function () use ($id, $inspections, $user, $input) {
                    // application status update
                    $application = $inspections->application;
                    $application->status = Configure::read('application_status')['Investigated'];
                    $application->update_time = time();
                    $application->update_by = $user['id'];
                    if($this->Inspections->Applications->save($application)){
                        // inspection status update
                        $inspections->status = Configure::read('inspections_status')['done'];
                        $inspections->update_by = $user['id'];
                        $inspections->update_time = time();
                        if($this->Inspections->save($inspections)){
                            // entry new inspection result
                            $inspectionResultEntity = $this->Inspections->InspectionResults->newEntity();
                            $inspectionResultEntity->office_id = $user['office_id'];
                            $inspectionResultEntity->application_id = $inspections['application_id'];
                            $inspectionResultEntity->inspection_id = $inspections['id'];
                            $inspectionResultEntity->actual_inspection_date = strtotime($input['actual_inspection_date']);
                            $inspectionResultEntity->inspection_summary = $input['inspection_summary'];
                            $inspectionResultEntity->have_file = $input['have_file'];
                            $inspectionResultEntity->create_by = $user['id'];
                            $inspectionResultEntity->create_time = time();
                            if($inspectionResult = $this->Inspections->InspectionResults->save($inspectionResultEntity)){
                                // entry new inspection result file
                                if($input['have_file']){
                                        $this->loadModel('InspectionResultFiles');
                                        foreach($input['document_file'] as $key=>$file){
                                            $inspectionResultFileEntity = $this->InspectionResultFiles->newEntity();
                                            $inspectionResultFileEntity->application_id = $inspections['application_id'];
                                            $inspectionResultFileEntity->inspection_result_id = $inspectionResult['id'];
                                            $inspectionResultFileEntity->file_location = $file;
                                            $inspectionResultFileEntity->file_label = $input['file_label'][$key];
                                            if(!$this->InspectionResultFiles->save($inspectionResultFileEntity))
                                                return false;
                                        }
                                }
                            }

                        }
                        else
                            return false;

                    }
                    else
                        return false;
                    // redirect to index
                    $this->Flash->success('Inspection result saved Successfully');
                    return $this->redirect(['action' => 'index']);
                });
            }
            catch (\Exception $e) {
                $this->Flash->error('Inspection Result could not be Saved. Please, try again.');
            }
        }
        $this->set(compact('inspections'));
        $this->set('_serialize', ['inspections']);
    }
}
