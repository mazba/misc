<?php
namespace App\Controller;

use App\Controller\AppController;

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
