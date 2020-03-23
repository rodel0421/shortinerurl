<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * EquipmentTypes Controller
 *
 * @property \App\Model\Table\EquipmentTypesTable $EquipmentTypes
 */
class EquipmentTypesController extends AppController
{

     public function isAuthorized($user){
        // Bare minimum to all
        /*
         * 
            1 	Admin
            2 	Officer / Manager
            3 	Read Only
            4 	Staff
            5 	User / Operator
            6 	Student
            7 	Limited
         */
        
        
        //Read Only can list 
        if (in_array($this->request->action, ['index'])) {
            if ($user['group_id'] <= 3) {
                return true;
            }
        }
        
        //managers can add / edit
        if (in_array($this->request->action, ['add','edit','delete'])) {
            if ($user['group_id'] <= 2) {
                return true;
            }
        }
        
        //Admins have all
        return parent::isAuthorized($user);
    }
    
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $contain = [];
    	
    	$conditions = array();
    	
    	$alt = [];
        
    	$conditions = $this->buildConditions($this->EquipmentTypes,$alt);
        
        if(!$this->request->query('archived')){
            $conditions['EquipmentTypes.active']=1;
        }else{
            $conditions['EquipmentTypes.active']=0;
        }
        
        $this->paginate = [
            'contain' => $contain,
            'conditions'=>$conditions,
            'limit' => 30,
            'order' => [
                'title'
            ]
        ];
        
        $equipmentTypes = $this->paginate($this->EquipmentTypes);

        $this->set(compact('equipmentTypes'));
        
    }


    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $equipmentType = $this->EquipmentTypes->newEntity();
        if ($this->request->is('post')) {
            $equipmentType = $this->EquipmentTypes->patchEntity($equipmentType, $this->request->data);
            if ($this->EquipmentTypes->save($equipmentType)) {
                $this->Flash->success(__('The equipment type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The equipment type could not be saved. Please, try again.'));
        }
        
        $categories = $this->EquipmentTypes->find('list',[
                'keyField'=>'category',
                'valueField'=>'category',
                'order'=>'category']);
        
        $this->set(compact('equipmentType','categories'));
        
    }

    /**
     * Edit method
     *
     * @param string|null $id Equipment Type id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $equipmentType = $this->EquipmentTypes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $equipmentType = $this->EquipmentTypes->patchEntity($equipmentType, $this->request->data);
            if ($this->EquipmentTypes->save($equipmentType)) {
                $this->Flash->success(__('The equipment type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The equipment type could not be saved. Please, try again.'));
        }
        
        $categories = $this->EquipmentTypes->find('list',['keyField'=>'category','valueField'=>'category','order'=>'category']);
        
        $this->set(compact('equipmentType','categories'));
        
    }

    /**
     * Delete method
     *
     * @param string|null $id Equipment Type id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $equipmentType = $this->EquipmentTypes->get($id);
        
        $msg = 'deleted';
        if($equipmentType->active){
            $equipmentType->active = 0;
        }else{
            $equipmentType->active = 1;
            $msg = 'restored';
        }
        
        if ($this->EquipmentTypes->save($equipmentType)) {
            $this->Flash->success(__('The equipment type has been '.$msg.'.'));
        } else {
            $this->Flash->error(__('The equipment type could not be '.$msg.'. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
