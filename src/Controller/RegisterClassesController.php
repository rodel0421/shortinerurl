<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * RegisterClasses Controller
 *
 * @property \App\Model\Table\RegisterClassesTable $RegisterClasses
 */
class RegisterClassesController extends AppController
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
        
        //managers can add / edit delete
        if (in_array($this->request->action, ['add','edit','delete'])) {
            if ($user['group_id'] <= 2) {
                return true;
            }
        }
        
        //Admins have all
        return parent::isAuthorized($user);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($id = null)
    {
        $registerTemplate = $this->RegisterClasses->RegisterTemplates->get($id, [
            'contain' => []
        ]);
        
        
        $registerClass = $this->RegisterClasses->newEntity();
        if ($this->request->is('post')) {
            $this->request->data['register_template_id'] = $id;
            $registerClass = $this->RegisterClasses->patchEntity($registerClass, $this->request->data);
            if ($this->RegisterClasses->save($registerClass)) {
                $this->Flash->success(__('The register class has been saved.'));

                return $this->redirect(['controller'=>'RegisterTemplates','action' => 'view',$registerTemplate->id]);
            }
            $this->Flash->error(__('The register class could not be saved. Please, try again.'));
        }
        
        $this->set(compact('registerClass', 'registerTemplate'));
        
    }

    /**
     * Edit method
     *
     * @param string|null $id Register Class id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $registerClass = $this->RegisterClasses->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $registerClass = $this->RegisterClasses->patchEntity($registerClass, $this->request->data);
            if ($this->RegisterClasses->save($registerClass)) {
                $this->Flash->success(__('The register class has been saved.'));

                return $this->redirect(['controller'=>'RegisterTemplates','action' => 'view',$registerClass->register_template_id]);
            }
            $this->Flash->error(__('The register class could not be saved. Please, try again.'));
        }
                
        $this->set(compact('registerClass'));
        
    }

    /**
     * Delete method
     *
     * @param string|null $id Register Class id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $registerClass = $this->RegisterClasses->get($id);
        
        $msg = 'deleted';
        
        if($registerClass->active){
            $registerClass->active = 0;
        }else{
            $registerClass->active = 1;
            $msg = 'restored';
        }
        
        if ($this->RegisterClasses->save($registerClass)) {
            $this->Flash->success(__('The register class has been '.$msg.'.'));
        } else {
            $this->Flash->error(__('The register class could not be '.$msg.'. Please, try again.'));
        }

        return $this->redirect(['controller'=>'RegisterTemplates','action' => 'view',$registerClass->register_template_id]);
    }
}
