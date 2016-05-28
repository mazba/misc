<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Designations Controller
 *
 * @property \App\Model\Table\DesignationsTable $Designations
 */
class DesignationsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $designations = $this->Designations->find('all', [
            'conditions' => ['Designations.status !=' => 99],
            'contain' => ['ParentDesignations', 'Offices']
        ]);
        $this->set(compact('designations'));
        $this->set('_serialize', ['designations']);
    }

    /**
     * View method
     *
     * @param string|null $id Designation id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $designation = $this->Designations->get($id, [
            'contain' => []
        ]);

        $this->set('designation', $designation);
        $this->set('_serialize', ['designation']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Auth->user();
        $time = time();

        $designation = $this->Designations->newEntity();

        if ($this->request->is('post')) {

            $data = $this->request->data;
            $data['create_by'] = $user['id'];
            $data['create_date'] = $time;
            $designation = $this->Designations->patchEntity($designation, $data);
//            echo"<pre/>";
//            print_r($designation);die();
           if ($this->Designations->save($designation)) {
                $this->Flash->success(__('The designation has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The designation could not be saved. Please, try again.'));
            }
        }
        $parentDesignations = $this->Designations->ParentDesignations->find('list')->where(['status'=>1]);
        $offices = $this->Designations->Offices->find('list')->where(['status'=>1]);
        $this->set(compact('designation','parentDesignations', 'offices'));
        $this->set('_serialize', ['designation']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Designation id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Auth->user();
        $time = time();

        $designation = $this->Designations->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {

            $data = $this->request->data;
            $data['update_by'] = $user['id'];
            $data['update_date'] = $time;

            $designation = $this->Designations->patchEntity($designation, $data);
            if ($this->Designations->save($designation)) {
                $this->Flash->success(__('The designation has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The designation could not be saved. Please, try again.'));
            }
        }

        $parentDesignations = $this->Designations->ParentDesignations->find('list')->where(['status'=>1]);
        $offices = $this->Designations->Offices->find('list')->where(['status'=>1]);
        $this->set(compact('designation','parentDesignations', 'offices'));
        $this->set('_serialize', ['designation']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Designation id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $designation = $this->Designations->get($id);
        if ($this->Designations->delete($designation)) {
            $this->Flash->success(__('The designation has been deleted.'));
        } else {
            $this->Flash->error(__('The designation could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
