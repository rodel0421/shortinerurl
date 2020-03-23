<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * RegisterTemplates Controller
 *
 * @property \App\Model\Table\RegisterTemplatesTable $RegisterTemplates
 */
class RegisterTemplatesController extends AppController
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
        if (in_array($this->request->action, ['index','view'])) {
            if ($user['group_id'] <= 3) {
                return true;
            }
        }
        
        //managers can add / edit delete
        if (in_array($this->request->action, ['add','edit','delete','reorder'])) {
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
        
    	$conditions = $this->buildConditions($this->RegisterTemplates,$alt);
        
        if(!$this->request->query('archived')){
            $conditions['RegisterTemplates.active']=1;
        }else{
            $conditions['RegisterTemplates.active']=0;
        }
        
        $this->paginate = [
            'contain' => $contain,
            'conditions'=>$conditions,
            'limit' => 30,
            'order' => [
                'RegisterTemplates.order'
            ]
        ];
        $registerTemplates = $this->paginate($this->RegisterTemplates);

        $this->set(compact('registerTemplates'));
        
    }
    
    public function reorder($id = null)
    {
        $registerTemplate = $this->RegisterTemplates->get($id, [
            'contain' => []
        ]);
        
        if($this->request->query('order')){
            $registerTemplate->order = (int) $this->request->query('order');
            $this->RegisterTemplates->save($registerTemplate);
        }
        
        $this->set('registerTemplate', $registerTemplate);
    }

    /**
     * View method
     *
     * @param string|null $id Register Template id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $registerTemplate = $this->RegisterTemplates->get($id, [
            'contain' => ['Departments', 'RegisterClasses']
        ]);

        $this->set('registerTemplate', $registerTemplate);
        
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $registerTemplate = $this->RegisterTemplates->newEntity();
        if ($this->request->is('post')) {
            $registerTemplate = $this->RegisterTemplates->patchEntity($registerTemplate, $this->request->data);
            if ($this->RegisterTemplates->save($registerTemplate)) {
                $this->Flash->success(__('The register template has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The register template could not be saved. Please, try again.'));
        }
        
        $this->loadModel('FormTemplates');
        $this->loadModel('CertificationTypes');
        
        $formTemplates = $this->FormTemplates->find('list',['order'=>'title','keyField'=>'title']);
        $certificationTypes = $this->CertificationTypes->find('list',['keyField'=>'type','valueField'=>'type','order'=>'type']);
        $departments = $this->RegisterTemplates->Departments->find('list', ['order' => 'name']);
        
        $this->set(compact('registerTemplate','formTemplates','certificationTypes','departments'));
        
    }

    /**
     * Edit method
     *
     * @param string|null $id Register Template id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $registerTemplate = $this->RegisterTemplates->get($id, [
            'contain' => ['Departments']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $registerTemplate = $this->RegisterTemplates->patchEntity($registerTemplate, $this->request->data);
            if ($this->RegisterTemplates->save($registerTemplate)) {
                $this->Flash->success(__('The register template has been saved.'));

                return $this->redirect(['action' => 'view',$id]);
            }
            $this->Flash->error(__('The register template could not be saved. Please, try again.'));
        }
        
        $this->loadModel('FormTemplates');
        $this->loadModel('CertificationTypes');
        
        $formTemplates = $this->FormTemplates->find('list',['order'=>'title','keyField'=>'title']);
        $certificationTypes = $this->CertificationTypes->find('list',['keyField'=>'type','valueField'=>'type','order'=>'type']);
        $departments = $this->RegisterTemplates->Departments->find('list', ['order' => 'name']);
        
        $this->set(compact('registerTemplate','formTemplates','certificationTypes','departments'));
        
    }

    /**
     * Delete method
     *
     * @param string|null $id Register Template id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $registerTemplate = $this->RegisterTemplates->get($id);
        
        $msg = 'deleted';
        
        if($registerTemplate->active){
            $registerTemplate->active = 0;
        }else{
            $registerTemplate->active = 1;
            $msg = 'restored';
        }
        
        if ($this->RegisterTemplates->save($registerTemplate)) {
            $this->Flash->success(__('The register template has been '.$msg.'.'));
        } else {
            $this->Flash->error(__('The register template could not be '.$msg.'. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
