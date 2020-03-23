<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * RegisterChecklists Controller
 *
 * @property \App\Model\Table\RegisterChecklistsTable $RegisterChecklists
 */
class RegisterChecklistsController extends AppController
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
        
        
        //Officer / Manager only
        if (in_array($this->request->action, ['update'])) {
            if ($user['group_id'] <= 2) {
                return true;
            }
        }
        
        //Admins have all
        return parent::isAuthorized($user);
    }
    
    public function beforeFilter(\Cake\Event\Event $event){
         $this->Security->config('unlockedActions', ['update']);
         return parent::beforeFilter($event);
    }
    
    public function update(){
        $status = 'ERR';
        if ($this->request->is(['patch', 'post', 'put'])) {
            
            try{
                $id = key($this->request->data);
                $registerChecklist = $this->RegisterChecklists->get($id, ['contain' => []]);
                $registerChecklist = $this->RegisterChecklists->patchEntity($registerChecklist, $this->request->data[$id]);
                if ($this->RegisterChecklists->save($registerChecklist)) {
                    $status = 'OK';
                }
            
            }catch(Cake\Datasource\Exception\RecordNotFoundException $e){
                
            }
        }
        $this->set('status', $status);
    }
}
