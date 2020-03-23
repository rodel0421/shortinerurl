<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * CertificationTypes Controller
 *
 * @property \App\Model\Table\CertificationTypesTable $CertificationTypes
 */
class CertificationTypesController extends AppController
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
        if (in_array($this->request->action, ['delete','add','edit'])) {
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
        $contain = ['CertificationClasses'];
    	
    	$conditions = [];
    	
    	$alt = [];
        
    	$conditions = $this->buildConditions($this->CertificationTypes,$alt);
        
        if(!$this->request->query('archived')){
            $conditions['CertificationTypes.active']=1;
        }else{
            $conditions['CertificationTypes.active']=0;
        }
        
        $this->paginate = [
            'contain' => $contain,
            'conditions'=>$conditions,
            'limit' => 30,
            'order' => [
                'CertificationTypes.name'
            ]
        ];
        
        $certificationClasses = $this->CertificationTypes->CertificationClasses->find('list', ['order' => 'name','conditions'=>['active'=>true]]);
        $types = $this->CertificationTypes->find('list',
                    ['keyField'=>'type','valueField'=>'type','order'=>'type']);
        $categories = $this->CertificationTypes->find('list',
                    ['keyField'=>'category','valueField'=>'category','order'=>'category']);
        
        $certificationTypes = $this->paginate($this->CertificationTypes);

        $this->set(compact('certificationTypes','categories','types','certificationTypes','certificationClasses'));
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $certificationType = $this->CertificationTypes->newEntity();
        if ($this->request->is('post')) {
            $certificationType = $this->CertificationTypes->patchEntity($certificationType, $this->request->data);
            if ($this->CertificationTypes->save($certificationType)) {
                $this->Flash->success(__('The certification type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The certification type could not be saved. Please, try again.'));
        }
        $certificationClasses = $this->CertificationTypes->CertificationClasses->find('list', ['order' => 'name','conditions'=>['active'=>true]]);
        $types = $this->CertificationTypes->find('list',
                    ['keyField'=>'type','valueField'=>'type','order'=>'type']);
        $categories = $this->CertificationTypes->find('list',
                    ['keyField'=>'category','valueField'=>'category','order'=>'category']);
        
        $this->set(compact('certificationType', 'certificationClasses','types','categories'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Certification Type id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $certificationType = $this->CertificationTypes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $certificationType = $this->CertificationTypes->patchEntity($certificationType, $this->request->data);
            if ($this->CertificationTypes->save($certificationType)) {
                $this->Flash->success(__('The certification type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The certification type could not be saved. Please, try again.'));
        }
        
        $certificationClasses = $this->CertificationTypes->CertificationClasses->find('list', ['order' => 'name','conditions'=>['active'=>true]]);
        $types = $this->CertificationTypes->find('list',['keyField'=>'type','valueField'=>'type','order'=>'type']);
        $categories = $this->CertificationTypes->find('list',['keyField'=>'category','valueField'=>'category','order'=>'category']);
        
        $this->set(compact('certificationType', 'certificationClasses','types','categories'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Certification Type id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $certificationType = $this->CertificationTypes->get($id);
        
        $msg = 'deleted';
        if($certificationType->active){
            $certificationType->active = 0;
        }else{
            $certificationType->active = 1;
            $msg = 'restored';
        }
        if ($this->CertificationTypes->save($certificationType)) {
            $this->Flash->success(__('The certification type has been '.$msg.'.'));
        } else {
            $this->Flash->error(__('The certification type could not be '.$msg.'. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
