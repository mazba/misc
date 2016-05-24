<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Collection\Collection;
use Cake\ORM\TableRegistry;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{

    public $paginate = [
        'limit' => 15,
        'order' => [
            'Users.id' => 'desc'
        ]
    ];

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $users = $this->Users->find('all', [
            'conditions' => ['Users.status !=' => 99],
            'contain' => ['Offices', 'UserGroups']
        ]);
        $this->set('users', $this->paginate($users));
        $this->set('_serialize', ['users']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Auth->user();
        $user = $this->Users->get($id, [
            'contain' => ['Offices', 'UserGroups']
        ]);
        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->loadModel('Designations');
        $this->loadModel('OfficeUnits');
        $auth = $this->Auth->user();
        $time = time();
        $user = $this->Users->newEntity();

        if ($this->request->is('post')) {
            $data = $this->request->data;

            $data['user_basic']['date_of_birth'] = strtotime($data['user_basic']['date_of_birth']);

            $data['create_by'] = $auth['id'];
            $data['create_date'] = $time;

            $data['office_id'] = 1;

            for ($i = 0; $i < count($data['user_designations']); $i++) {
                $data['user_designations'][$i]['starting_date'] = strtotime($data['user_designations'][$i]['starting_date']);
                $data['user_designations'][$i]['ending_date'] = strtotime($data['user_designations'][$i]['ending_date']);
                $data['user_designations'][$i]['create_by'] = $auth['id'];
                $data['user_designations'][$i]['create_time'] = $time;
            }


            $user = $this->Users->patchEntity($user, $data, [
                'associated' => [
                    'UserBasics',
                    'UserDesignations',

                ]
            ]);


            if ($this->Users->save($user)) {
                $this->Flash->success('The user has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The user could not be saved. Please, try again.');
            }
        }
        $Designations = $this->Designations->find('list', ['conditions' => ['office_id' => 1, 'status' => 1]]);
        $OfficeUnits = $this->OfficeUnits->find('list', ['conditions' => ['office_id' => 1, 'status' => 1]]);

        $userGroups = $this->Users->UserGroups->find('list', ['conditions' => ['status' => 1]]);
        $this->set(compact('user', 'Designations', 'OfficeUnits', 'userGroups'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->loadModel('Designations');
        $this->loadModel('OfficeUnits');
        $this->loadModel('OfficeUnitDesignations');
        $auth = $this->Auth->user();
        $time = time();
        $user = $this->Users->get($id, [
            'contain' => [
                'UserBasics',
                'UserDesignations' => ['conditions' => ['UserDesignations.status' => 1]]
            ]
        ]);

        $missing_designations = array();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->data;
            $collection = new Collection($data['user_designations']);
            $update_designations = $collection->extract('id');
            $update_designations = $update_designations->toArray();
            foreach ($user['user_designations'] as $rr) {
                if (!in_array($rr['id'], $update_designations)) {
                    $missing_designations[] = $rr['id'];
                }
            }

            for ($i = 0; $i < count($data['user_designations']); $i++) {
                $data['user_designations'][$i]['starting_date'] = strtotime($data['user_designations'][$i]['starting_date']);
                $data['user_designations'][$i]['ending_date'] = strtotime($data['user_designations'][$i]['ending_date']);
                $data['user_designations'][$i]['update_time'] = $time;
                $data['user_designations'][$i]['update_by'] = $auth['id'];
            }
            // delete old missing designations
            if ($missing_designations) {
                $userDesignationTbl = TableRegistry::get('user_designations')
                    ->updateAll(['status' => 99], ['id IN' => $missing_designations]);
            }


            if ($data['update_password']) {
                $data['password'] = $data['update_password'];
            } else {
                $data['password'] = $user['password'];
            }

            $data['user_basic']['date_of_birth'] = strtotime($data['user_basic']['date_of_birth']);

            $data['update_by'] = $auth['id'];
            $data['update_date'] = $time;
            $user = $this->Users->patchEntity($user, $data, ['associated' => ['UserBasics', 'UserDesignations']]);

            if ($this->Users->save($user)) {
                $this->Flash->success('The user has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The user could not be saved. Please, try again.');
            }
        }

        $Unit_designations = $this->OfficeUnitDesignations->find('list', ['conditions' => ['office_id' => 1, 'status' => 1]]);
        $Designations = $this->Designations->find('list', ['conditions' => ['office_id' => 1, 'status' => 1]]);

        $OfficeUnits = $this->OfficeUnits->find('list', ['conditions' => ['office_id' => 1, 'status' => 1]]);
        $offices = $this->Users->Offices->find('list', ['conditions' => ['status' => 1]]);
        $userGroups = $this->Users->UserGroups->find('list', ['conditions' => ['status' => 1]]);
        $this->set(compact('user', 'Designations', 'Unit_designations', 'OfficeUnits', 'offices', 'userGroups'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {

        $user = $this->Users->get($id, [
            'contain' => ['UserBasics', 'UserDesignations']
        ]);


        $auth = $this->Auth->user();
        $data = $this->request->data;
        $time = time();

        $data['updated_by'] = $auth['id'];
        $data['updated_date'] = $time;
        $data['status'] = 99;

        for ($i = 0; $i < count($user['user_designations']); $i++) {
            $data['user_designations'][$i]['id'] = $user['user_designations'][$i]['id'];
            $data['user_designations'][$i]['status'] = 99;
            $data['user_designations'][$i]['updated_by'] = $auth['id'];
            $data['user_designations'][$i]['update_time'] = $time;
        }

        $data['user_basic']['updated_by'] = $auth['id'];
        $data['user_basic']['update_time'] = $time;
        $data['user_basic']['status'] = 99;

        $user = $this->Users->patchEntity($user, $data, ['Associations' => ['UserBasics', 'UserDesignations']]);
        if ($this->Users->save($user)) {
            $this->Flash->success('The user has been deleted.');
        } else {
            $this->Flash->error('The user could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }


    public function ajax($action = null)
    {

        if ($action == 'get_unit_designation') {
            //  $office_id = $this->request->data('office_id');
            $office_unit_id = $this->request->data('office_unit_id');
            $this->loadModel('OfficeUnitDesignations');
            $designations = $this->OfficeUnitDesignations->find('list', ['conditions' => ['office_unit_id' => $office_unit_id, 'status' => 1]]);

            $this->response->body(json_encode($designations));
            return $this->response;
        }


    }
}
