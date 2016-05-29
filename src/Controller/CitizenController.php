<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;


/**
 * Citizen Controller
 *
 */
class CitizenController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow();
        $this->viewBuilder()->layout('website');
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {

    }


    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function newCase()
    {
        $this->loadModel('Applications');
     //   $this->loadModel('');


        $application = $this->Applications->newEntity();

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

            $application = $this->Users->patchEntity($application, $data,[
                'associated'=>['UserBasics']
            ]);

            //      echo "<pre/>"; print_r($user);die();
            if ($this->Users->save($application)) {
                $this->Flash->success(__('The application has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The application could not be saved. Please, try again.'));
            }
        }


        $divisions = TableRegistry::get('Divisions')->find('list', ['limit' => 200]);
        $this->set(compact('application','divisions'));
        $this->set('_serialize', ['application']);

    }
    /**
     * search method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function search(){
        $input = $this->request->data();
        echo '<pre>';
        print_r($input);
        echo '</pre>';
        die;
    }

}
