<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
/**
 * Common Controller
 *
 * @property \App\Model\Table\CommonTable $Common
 */
class CommonController extends AppController
{

    public function ajax($action){
        if($action == 'get_zone_district')
        {
            $division_id = $this->request->data('division_id');
            $AreaDistricts=TableRegistry::get('Districts')->find('list')->where(['division_id'=>$division_id]);
            $this->response->body(json_encode(['district'=>$AreaDistricts]));
            return $this->response;

        }elseif($action == 'get_upazila') {
            $district_id = $this->request->data('district_id');
            $AreaUpazilas=TableRegistry::get('Upazilas')->find('list')->where(['district_id'=>$district_id]);
            $this->response->body(json_encode($AreaUpazilas));
            return $this->response;

        }elseif($action == 'get_office') {
            $division_id = $this->request->data('division_id');
            $district_id = $this->request->data('district_id');
            $upazila_id = $this->request->data('upazila_id');

            $Offices=TableRegistry::get('offices')->find('list');

            if(!empty($division_id)){
                $Offices->where([ 'division_id'=>$division_id]);
            }if(!empty($district_id)){
                $Offices->where([ 'district_id'=>$district_id]);
            }if(!empty($upazila_id)){
                $Offices->where([ 'upazila_id'=>$upazila_id]);
            }

            $this->response->body(json_encode($Offices));
            return $this->response;
        }
    }

//    /**
//     * Index method
//     *
//     * @return \Cake\Network\Response|null
//     */
//    public function index()
//    {
//        $common = $this->paginate($this->Common);
//
//        $this->set(compact('common'));
//        $this->set('_serialize', ['common']);
//    }
//
//    /**
//     * View method
//     *
//     * @param string|null $id Common id.
//     * @return \Cake\Network\Response|null
//     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
//     */
//    public function view($id = null)
//    {
//        $common = $this->Common->get($id, [
//            'contain' => []
//        ]);
//
//        $this->set('common', $common);
//        $this->set('_serialize', ['common']);
//    }
//
//    /**
//     * Add method
//     *
//     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
//     */
//    public function add()
//    {
//        $common = $this->Common->newEntity();
//        if ($this->request->is('post')) {
//            $common = $this->Common->patchEntity($common, $this->request->data);
//            if ($this->Common->save($common)) {
//                $this->Flash->success(__('The common has been saved.'));
//                return $this->redirect(['action' => 'index']);
//            } else {
//                $this->Flash->error(__('The common could not be saved. Please, try again.'));
//            }
//        }
//        $this->set(compact('common'));
//        $this->set('_serialize', ['common']);
//    }
//
//    /**
//     * Edit method
//     *
//     * @param string|null $id Common id.
//     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
//     * @throws \Cake\Network\Exception\NotFoundException When record not found.
//     */
//    public function edit($id = null)
//    {
//        $common = $this->Common->get($id, [
//            'contain' => []
//        ]);
//        if ($this->request->is(['patch', 'post', 'put'])) {
//            $common = $this->Common->patchEntity($common, $this->request->data);
//            if ($this->Common->save($common)) {
//                $this->Flash->success(__('The common has been saved.'));
//                return $this->redirect(['action' => 'index']);
//            } else {
//                $this->Flash->error(__('The common could not be saved. Please, try again.'));
//            }
//        }
//        $this->set(compact('common'));
//        $this->set('_serialize', ['common']);
//    }
//
//    /**
//     * Delete method
//     *
//     * @param string|null $id Common id.
//     * @return \Cake\Network\Response|null Redirects to index.
//     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
//     */
//    public function delete($id = null)
//    {
//        $this->request->allowMethod(['post', 'delete']);
//        $common = $this->Common->get($id);
//        if ($this->Common->delete($common)) {
//            $this->Flash->success(__('The common has been deleted.'));
//        } else {
//            $this->Flash->error(__('The common could not be deleted. Please, try again.'));
//        }
//        return $this->redirect(['action' => 'index']);
//    }
}
