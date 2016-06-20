<?php
namespace App\Controller;

use Cake\Core\Configure;
use Cake\ORM\TableRegistry;

/**
 * InspectionResults Controller
 *
 * @property \App\Model\Table\InspectionResultsTable $InspectionResults
 */
class InspectionResultsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $user = $this->Auth->user();

        $applications = $this->InspectionResults->find('all', [
            'conditions' => [
                'Applications.division_id' => $user['division_id'],
                'Applications.district_id' => $user['district_id'],
                'InspectionResults.status' => 1,
            ],
            'group' => ['InspectionResults.application_id'],
            'contain' => [
                'Applications'
            ]
        ]);
        foreach ($applications as $application) {
            $Parties = TableRegistry::get('Parties')->find();
            $Parties->where(['application_id' => $application['application']['id'], 'type' => Configure::read('party_type')['appellant']]);

            $Upazilas = TableRegistry::get('Upazilas')->find();
            $Upazilas->where(['id' => $application['application']['upazila_id']]);

            $Mouja = TableRegistry::get('Moujas')->find();
            $Mouja->where(['id' => $application['application']['mouja_id']]);

            $Mouja = TableRegistry::get('Moujas')->find();
            $Mouja->where(['id' => $application['application']['mouja_id']]);

            $application['parties'] = $Parties->first();
            $application['upazila'] = $Upazilas->first();
            $application['mouja'] = $Mouja->first();
        }


        $this->set(compact('applications'));
        $this->set('_serialize', ['applications']);
    }

    /**
     * View method
     *
     * @param string|null $id Inspection Result id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($pram = null)
    {
        $pram = $this->Common->hashids()->decode($pram);
        if(empty($pram))
        {
            $this->Flash->error(__('Invalid Url'));
            return $this->redirect(['action' => 'index']);
        }
        $id = $pram[0];

        $inspectionResult = $this->InspectionResults->find('all', [
        'conditions' => ['InspectionResults.application_id' => $id],
            'order'=>['actual_inspection_date'=>'DESC'],
        'contain' => [
            'Applications'
        ]
    ]);

        foreach($inspectionResult as $result){

        $InspectionResultFiles = TableRegistry::get('InspectionResultFiles')->find();
            $InspectionResultFiles->where(['inspection_result_id' => $result->id,'application_id' => $id]);
            $result['inspectionResultFiles'] = $InspectionResultFiles->toArray();
        }
//`echo "<pre>";print_r($inspectionResult->toArray());die();
        $this->set('inspectionResult', $inspectionResult);
        $this->set('_serialize', ['inspectionResult']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $inspectionResult = $this->InspectionResults->newEntity();
        if ($this->request->is('post')) {
            $inspectionResult = $this->InspectionResults->patchEntity($inspectionResult, $this->request->data);
            if ($this->InspectionResults->save($inspectionResult)) {
                $this->Flash->success(__('The inspection result has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The inspection result could not be saved. Please, try again.'));
            }
        }
        $offices = $this->InspectionResults->Offices->find('list', ['limit' => 200]);
        $applications = $this->InspectionResults->Applications->find('list', ['limit' => 200]);
        $inspections = $this->InspectionResults->Inspections->find('list', ['limit' => 200]);
        $this->set(compact('inspectionResult', 'offices', 'applications', 'inspections'));
        $this->set('_serialize', ['inspectionResult']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Inspection Result id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $inspectionResult = $this->InspectionResults->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $inspectionResult = $this->InspectionResults->patchEntity($inspectionResult, $this->request->data);
            if ($this->InspectionResults->save($inspectionResult)) {
                $this->Flash->success(__('The inspection result has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The inspection result could not be saved. Please, try again.'));
            }
        }
        $offices = $this->InspectionResults->Offices->find('list', ['limit' => 200]);
        $applications = $this->InspectionResults->Applications->find('list', ['limit' => 200]);
        $inspections = $this->InspectionResults->Inspections->find('list', ['limit' => 200]);
        $this->set(compact('inspectionResult', 'offices', 'applications', 'inspections'));
        $this->set('_serialize', ['inspectionResult']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Inspection Result id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $inspectionResult = $this->InspectionResults->get($id);
        if ($this->InspectionResults->delete($inspectionResult)) {
            $this->Flash->success(__('The inspection result has been deleted.'));
        } else {
            $this->Flash->error(__('The inspection result could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
