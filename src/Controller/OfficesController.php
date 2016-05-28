<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Offices Controller
 *
 * @property \App\Model\Table\OfficesTable $Offices
 */
class OfficesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['ParentOffices', 'Divisions', 'Districts', 'Upazilas']
        ];
        $offices = $this->paginate($this->Offices);

        $this->set(compact('offices'));
        $this->set('_serialize', ['offices']);
    }

    /**
     * View method
     *
     * @param string|null $id Office id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $office = $this->Offices->get($id, [
            'contain' => ['ParentOffices', 'Divisions', 'Districts', 'Upazilas', 'Applications', 'Designations', 'Inspections', 'ChildOffices', 'Users']
        ]);

        $this->set('office', $office);
        $this->set('_serialize', ['office']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $office = $this->Offices->newEntity();
        $user = $this->Auth->user();
        $time = time();

        if ($this->request->is('post')) {
            $data = $this->request->data;
            $data['create_by'] = $user['id'];
            $data['update_time'] = $time;

            $office = $this->Offices->patchEntity($office, $data);
//            echo"<pre/>";
//            print_r(  $office);die();
            if ($this->Offices->save($office)) {
                $this->Flash->success(__('The office has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The office could not be saved. Please, try again.'));
            }
        }
        $parentOffices = $this->Offices->ParentOffices->find('list', ['limit' => 200]);
        $divisions = $this->Offices->Divisions->find('list', ['limit' => 200]);

        $this->set(compact('office', 'parentOffices', 'divisions'));
        $this->set('_serialize', ['office']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Office id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Auth->user();
        $time = time();

        $office = $this->Offices->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {

            $data['update_by'] = $user['id'];
            $data['update_time'] = $time;

            $office = $this->Offices->patchEntity($office,$data);
            if ($this->Offices->save($office)) {
                $this->Flash->success(__('The office has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The office could not be saved. Please, try again.'));
            }
        }
        $parentOffices = $this->Offices->ParentOffices->find('list', ['limit' => 200]);
        $divisions = $this->Offices->Divisions->find('list', ['limit' => 200]);
        $districts = $this->Offices->Districts->find('list', ['limit' => 200]);
        $upazilas = $this->Offices->Upazilas->find('list', ['limit' => 200]);
        $this->set(compact('office', 'parentOffices', 'divisions', 'districts', 'upazilas'));
        $this->set('_serialize', ['office']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Office id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $office = $this->Offices->get($id);
        if ($this->Offices->delete($office)) {
            $this->Flash->success(__('The office has been deleted.'));
        } else {
            $this->Flash->error(__('The office could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }


}
