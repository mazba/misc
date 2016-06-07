<?php
namespace App\Controller;

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
//        $this->loadModel('Lawyers');
       $this->loadModel('ApplicationFiles');


        $application = $this->Applications->newEntity();

        if ($this->request->is('post')) {
            $time = time();
            $data= $this->request->data;
         //  echo "<pre>";print_r($data);die();
         //   echo "<pre>";print_r($data['application_files']);die();
            $data['create_time'] = $time;
            $data['case_create_time'] = $time;
            $data['status']=1;


            for ($i = 0; $i < count($data['appellants']); $i++) {
                $data['appellants'][$i]['create_time'] = $time;
                $data['appellants'][$i]['status'] = 1;
            }
            for ($i = 0; $i < count($data['defendants']); $i++) {
                $data['defendants'][$i]['create_time'] = $time;
                $data['defendants'][$i]['status'] = 1;
            }
            for ($i = 0; $i < count($data['lawyers']); $i++) {
                $data['lawyers'][$i]['create_time'] = $time;
                $data['lawyers'][$i]['status'] = 1;
            }
            $application = $this->Applications->patchEntity($application, $data,[
                'associated'=>[
                    'Lawyers',
                    'Appellants',
                    'Defendants'
                ]
            ]);
           //    echo "<pre/>"; print_r($application);die();
            if ($application_id = $this->Applications->save($application)) {

                foreach ( $data['application_files'] as $file){
                    $applicationFilesEntity = $this->Applications->ApplicationFiles->newEntity();
                    $applicationFilesEntity->title = $file['title'];
                    $applicationFilesEntity->application_id =$application_id['id'];
                    $applicationFilesEntity->file_location = $file['file_location'];
                  //  echo "<pre>";print_r($applicationFilesEntity);die();
                     $this->Applications->ApplicationFiles->save($applicationFilesEntity);


                }
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
