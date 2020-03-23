<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * RegisterForms Controller
 *
 * @property \App\Model\Table\RegisterFormsTable $RegisterForms
 */
class RegisterFormsController extends AppController
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
        //Everyone has access.
        //Permissions are checked in each function
        return true;
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($register_id = null)
    {
        $register = $this->RegisterForms->Registers->get($register_id, [
            'contain' => ['RegisterTemplates']
        ]);
        
        
        $group = $this->Auth->user('group_id');
        $user_id = $this->Auth->user('id');
        if((!$group || $group > 3) && $register->user_id != $user_id){//4 staff and below lock to own account
            $this->Flash->error(__('You do not have access to this record.'));
            return $this->redirect($this->referer());
        }
        
        
        $formTitle = $this->request->query('form');
        
        $this->loadModel('FormTemplates');
        $form = $this->FormTemplates->find()
                ->where(['title'=>$formTitle])->first();
        
        if(empty($form->form)){
            $this->Flash->error(__('The register form could not be completed at this time. Please, contact support.'));
            return $this->redirect(['controller'=>'Registers','action' => 'view',$register_id]);
        }
        
        $registerForm = $this->RegisterForms->newEntity();
        if ($this->request->is('post')) {
            
            $this->request->data['title'] = $form->title;
            $this->request->data['user_id'] = $register->user_id;
            $this->request->data['register_id'] = $register->id;
            $registerForm = $this->RegisterForms->patchEntity($registerForm, $this->request->data);
            if ($this->RegisterForms->save($registerForm)) {
                $this->Flash->success(__('The register form has been saved.'));

                return $this->redirect(['controller'=>'Registers','action' => 'view',$register_id]);
            }
            $this->Flash->error(__('The register form could not be saved. Please, try again.'));
        }
        
        $this->set(compact('registerForm', 'register','form'));
        
    }

    /**
     * Edit method
     *
     * @param string|null $id Register Form id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $registerForm = $this->RegisterForms->get($id, [
            'contain' => ['Registers']
        ]);
        
        $group = $this->Auth->user('group_id');
        $user_id = $this->Auth->user('id');
        if((!$group || $group > 3) && $registerForm->register->user_id != $user_id){//4 staff and below lock to own account
            $this->Flash->error(__('You do not have access to this record.'));
            return $this->redirect($this->referer());
        }
        
        $this->loadModel('FormTemplates');
        $form = $this->FormTemplates->find()
                ->where(['title'=>$registerForm->title])->first();
        
        if(empty($form->form)){
            $this->Flash->error(__('The register form could not be completed at this time. Please, contact support.'));
            return $this->redirect(['controller'=>'Registers','action' => 'view',$registerForm->register_id]);
        }
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $registerForm = $this->RegisterForms->patchEntity($registerForm, $this->request->data);
            if ($this->RegisterForms->save($registerForm)) {
                $this->Flash->success(__('The register form has been saved.'));

                return $this->redirect(['controller'=>'Registers','action' => 'view',$registerForm->register_id]);
            }
            $this->Flash->error(__('The register form could not be saved. Please, try again.'));
        }
        
        $this->set(compact('registerForm', 'form'));
        
    }

    /**
     * Delete method
     *
     * @param string|null $id Register Form id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $registerForm = $this->RegisterForms->get($id);
        if ($this->RegisterForms->delete($registerForm)) {
            $this->Flash->success(__('The register form has been deleted.'));
        } else {
            $this->Flash->error(__('The register form could not be deleted. Please, try again.'));
        }

        return $this->redirect(['controller'=>'Registers','action' => 'view',$registerForm->register_id]);
    }
}
