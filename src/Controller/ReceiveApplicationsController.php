<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;

/**
 * ReceiveApplications Controller
 *
 * @property \App\Model\Table\ApplicationsTable $Applications
 */
class ReceiveApplicationsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->loadModel('Applications');
        $application_status = Configure::read('application_status');
        $applications = $this->Applications
            ->find()
            ->where(['status'=>$application_status['Pending']]);
        $applications = $this->paginate($applications);

        $this->set(compact('applications'));
        $this->set('_serialize', ['applications']);
    }

    /**
     * View method
     *
     * @param string|null $id Receive Application id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $receiveApplication = $this->ReceiveApplications->get($id, [
            'contain' => []
        ]);

        $this->set('receiveApplication', $receiveApplication);
        $this->set('_serialize', ['receiveApplication']);
    }

    /**
     * Receive application method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function receive($id=null)
    {
        $receiveApplication = $this->ReceiveApplications->newEntity();
        if ($this->request->is('post')) {
            $receiveApplication = $this->ReceiveApplications->patchEntity($receiveApplication, $this->request->data);
            if ($this->ReceiveApplications->save($receiveApplication)) {
                $this->Flash->success(__('The receive application has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The receive application could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('receiveApplication'));
        $this->set('_serialize', ['receiveApplication']);
    }

    /**
     * Reject method
     *
     * @param string|null $id Receive Application id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function reject($id = null)
    {
        $receiveApplication = $this->ReceiveApplications->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $receiveApplication = $this->ReceiveApplications->patchEntity($receiveApplication, $this->request->data);
            if ($this->ReceiveApplications->save($receiveApplication)) {
                $this->Flash->success(__('The receive application has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The receive application could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('receiveApplication'));
        $this->set('_serialize', ['receiveApplication']);
    }
    public function ajax($action=''){

    }
}
