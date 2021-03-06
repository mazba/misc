<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;


/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Offices', 'UserGroups']
        ];
        $users = $this->paginate($this->Users);
        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Offices', 'UserGroups', 'UserBasics']
        ]);

      //echo "<pre>";print_r($user);die();

        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $userEntity = $this->Users->newEntity();
        $user = $this->Auth->user();
        if ($this->request->is('post')) {
            $auth = $this->Auth->user();
            $time = time();
            $data= $this->request->data;
            $data['create_by'] = $auth['id'];
            $data['create_date'] = $time;
            $data['user_basics']['create_by'] = $auth['id'];
            $data['user_basics']['create_date'] = $time;
            $data['user_basic']['date_of_birth'] = strtotime($data['user_basic']['date_of_birth']);
            $data['status']=1;
            //check the user label
            $user_groups = Configure::read('user_group');
            if($user['user_group_id'] != $user_groups['super_admin'] && $user['user_group_id'] != $user_groups['hq_office']) {
                $data['user_group_id'] = $user['user_group_id'];
                $data['office_id'] = $user['office_id'];
            }
                $userEntity = $this->Users->patchEntity($userEntity, $data,[
                'associated'=>['UserBasics']
            ]);

      //      echo "<pre/>"; print_r($user);die();
            if ($this->Users->save($userEntity)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }

        $offices = $this->Users->Offices->find('list');
        $userGroups = $this->Users->UserGroups->find('list');
        $designations = $this->Users->Designations->find('list');
        $divisions = TableRegistry::get('Divisions')->find('list');
        $this->set(compact('offices', 'userGroups','designations','divisions'));
        $this->set('user',$userEntity);
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $userEntity = $this->Users->get($id, [
            'contain' => ['UserBasics']
        ]);
        $user = $this->Auth->user();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $auth = $this->Auth->user();
            $time = time();

            $data=$this->request->data;

            if ($data['update_password']) {
                $data['password'] = $data['update_password'];
            }

            $data['update_by'] = $auth['id'];
            $data['update_date'] = $time;

            $data['user_basics']['update_time'] = $auth['id'];
            $data['user_basics']['update_by'] = $time;

            $data['user_basic']['date_of_birth'] = strtotime($data['user_basic']['date_of_birth']);
            //check the user label
            $user_groups = Configure::read('user_group');
            if($user['user_group_id'] != $user_groups['super_admin'] && $user['user_group_id'] != $user_groups['hq_office']) {
                $data['user_group_id'] = $user['user_group_id'];
                $data['office_id'] = $user['office_id'];
            }
            $userEntity = $this->Users->patchEntity($userEntity, $data);

            if ($this->Users->save($userEntity)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $offices = $this->Users->Offices->find('list');
        $userGroups = $this->Users->UserGroups->find('list');
        $designations = $this->Users->Designations->find('list');
        $divisions = TableRegistry::get('Divisions')->find('list');
        $this->set(compact('offices', 'userGroups','designations','divisions'));
        $this->set('user',$userEntity);
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
