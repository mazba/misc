<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Applications Controller
 *
 * @property \App\Model\Table\ApplicationsTable $Applications
 */
class ApplicationsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['ParentApplications', 'Offices', 'Divisions', 'Districts', 'Upazilas', 'Moujas']
        ];
        $applications = $this->paginate($this->Applications);

        $this->set(compact('applications'));
        $this->set('_serialize', ['applications']);
    }

    /**
     * View method
     *
     * @param string|null $id Application id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $application = $this->Applications->get($id, [
            'contain' => ['ParentApplications', 'Offices', 'Divisions', 'Districts', 'Upazilas', 'Moujas', 'ApplicationFiles', 'ChildApplications', 'InspectionResultFiles', 'InspectionResults', 'Payments']
        ]);

        $this->set('application', $application);
        $this->set('_serialize', ['application']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $application = $this->Applications->newEntity();
        if ($this->request->is('post')) {
            $application = $this->Applications->patchEntity($application, $this->request->data);
            if ($this->Applications->save($application)) {
                $this->Flash->success(__('The application has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The application could not be saved. Please, try again.'));
            }
        }
        $parentApplications = $this->Applications->ParentApplications->find('list', ['limit' => 200]);
        $offices = $this->Applications->Offices->find('list', ['limit' => 200]);
        $divisions = $this->Applications->Divisions->find('list', ['limit' => 200]);
        $districts = $this->Applications->Districts->find('list', ['limit' => 200]);
        $upazilas = $this->Applications->Upazilas->find('list', ['limit' => 200]);
        $moujas = $this->Applications->Moujas->find('list', ['limit' => 200]);
        $this->set(compact('application', 'parentApplications', 'offices', 'divisions', 'districts', 'upazilas', 'moujas'));
        $this->set('_serialize', ['application']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Application id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $application = $this->Applications->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $application = $this->Applications->patchEntity($application, $this->request->data);
            if ($this->Applications->save($application)) {
                $this->Flash->success(__('The application has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The application could not be saved. Please, try again.'));
            }
        }
        $parentApplications = $this->Applications->ParentApplications->find('list', ['limit' => 200]);
        $offices = $this->Applications->Offices->find('list', ['limit' => 200]);
        $divisions = $this->Applications->Divisions->find('list', ['limit' => 200]);
        $districts = $this->Applications->Districts->find('list', ['limit' => 200]);
        $upazilas = $this->Applications->Upazilas->find('list', ['limit' => 200]);
        $moujas = $this->Applications->Moujas->find('list', ['limit' => 200]);
        $this->set(compact('application', 'parentApplications', 'offices', 'divisions', 'districts', 'upazilas', 'moujas'));
        $this->set('_serialize', ['application']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Application id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $application = $this->Applications->get($id);
        if ($this->Applications->delete($application)) {
            $this->Flash->success(__('The application has been deleted.'));
        } else {
            $this->Flash->error(__('The application could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
