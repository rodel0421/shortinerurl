<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * CertificationClasses Controller
 *
 * @property \App\Model\Table\CertificationClassesTable $CertificationClasses
 */
class CertificationClassesController extends AppController
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
        
        
        //Read Only can list user accounts
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
    	
    	$conditions = [];
    	
    	$alt = [];
        
    	$conditions = $this->buildConditions($this->CertificationClasses,$alt);
        
        if(!$this->request->query('archived')){
            $conditions['CertificationClasses.active']=1;
        }else{
            $conditions['CertificationClasses.active']=0;
        }
        
        $this->paginate = [
            'contain' => $contain,
            'conditions'=>$conditions,
            'limit' => 30,
            'order' => [
                'name'
            ]
        ];
        
        
        $certificationClasses = $this->paginate($this->CertificationClasses);

        $this->set(compact('certificationClasses'));
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $certificationClass = $this->CertificationClasses->newEntity();
        if ($this->request->is('post')) {
            $certificationClass = $this->CertificationClasses->patchEntity($certificationClass, $this->request->data);
            if ($this->CertificationClasses->save($certificationClass)) {
                $this->Flash->success(__('The certification class has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The certification class could not be saved. Please, try again.'));
        }
        $this->set(compact('certificationClass'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Certification Class id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $certificationClass = $this->CertificationClasses->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $certificationClass = $this->CertificationClasses->patchEntity($certificationClass, $this->request->data);
            if ($this->CertificationClasses->save($certificationClass)) {
                $this->Flash->success(__('The certification class has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The certification class could not be saved. Please, try again.'));
        }
        $this->set(compact('certificationClass'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Certification Class id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $certificationClass = $this->CertificationClasses->get($id);
        
        $msg = 'deleted';
        if($certificationClass->active){
            $certificationClass->active = 0;
        }else{
            $certificationClass->active = 1;
            $msg = 'restored';
        }
        if ($this->CertificationClasses->save($certificationClass)) {
            $this->Flash->success(__('The certification class has been '.$msg.'.'));
        } else {
            $this->Flash->error(__('The certification class could not be '.$msg.'. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
