<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Moujas Controller
 *
 * @property \App\Model\Table\MoujasTable $Moujas
 */
class MoujasController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['UpazilaLisas', 'Upazilas', 'Districts', 'Divisions']
        ];
        $moujas = $this->paginate($this->Moujas);

        $this->set(compact('moujas'));
        $this->set('_serialize', ['moujas']);
    }

    /**
     * View method
     *
     * @param string|null $id Mouja id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $mouja = $this->Moujas->get($id, [
            'contain' => ['UpazilaLisas', 'Upazilas', 'Districts', 'Divisions', 'Applications']
        ]);

        $this->set('mouja', $mouja);
        $this->set('_serialize', ['mouja']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $mouja = $this->Moujas->newEntity();
        if ($this->request->is('post')) {
            $mouja = $this->Moujas->patchEntity($mouja, $this->request->data);
            if ($this->Moujas->save($mouja)) {
                $this->Flash->success(__('The mouja has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The mouja could not be saved. Please, try again.'));
            }
        }
        $upazilaLisas = $this->Moujas->UpazilaLisas->find('list', ['limit' => 200]);
        $upazilas = $this->Moujas->Upazilas->find('list', ['limit' => 200]);
        $districts = $this->Moujas->Districts->find('list', ['limit' => 200]);
        $divisions = $this->Moujas->Divisions->find('list', ['limit' => 200]);
        $this->set(compact('mouja', 'upazilaLisas', 'upazilas', 'districts', 'divisions'));
        $this->set('_serialize', ['mouja']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Mouja id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $mouja = $this->Moujas->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $mouja = $this->Moujas->patchEntity($mouja, $this->request->data);
            if ($this->Moujas->save($mouja)) {
                $this->Flash->success(__('The mouja has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The mouja could not be saved. Please, try again.'));
            }
        }
        $upazilaLisas = $this->Moujas->UpazilaLisas->find('list', ['limit' => 200]);
        $upazilas = $this->Moujas->Upazilas->find('list', ['limit' => 200]);
        $districts = $this->Moujas->Districts->find('list', ['limit' => 200]);
        $divisions = $this->Moujas->Divisions->find('list', ['limit' => 200]);
        $this->set(compact('mouja', 'upazilaLisas', 'upazilas', 'districts', 'divisions'));
        $this->set('_serialize', ['mouja']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Mouja id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $mouja = $this->Moujas->get($id);
        if ($this->Moujas->delete($mouja)) {
            $this->Flash->success(__('The mouja has been deleted.'));
        } else {
            $this->Flash->error(__('The mouja could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
