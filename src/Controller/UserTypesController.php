<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * UserTypes Controller
 *
 * @property \App\Model\Table\UserTypesTable $UserTypes
 *
 * @method \App\Model\Entity\UserType[] paginate($object = null, array $settings = [])
 */
class UserTypesController extends AppController
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
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $contain = [];
    	
    	$conditions = [];
    	
    	$alt = [];
        
    	$conditions = $this->buildConditions($this->UserTypes,$alt);
        
        if(!$this->request->query('archived')){
            $conditions['UserTypes.active']=1;
        }else{
            $conditions['UserTypes.active']=0;
        }
        
        $this->paginate = [
            'contain' => $contain,
            'conditions'=>$conditions,
            'limit' => 30,
            'order' => [
                'title'
            ]
        ];
        
        $userTypes = $this->paginate($this->UserTypes);

        $this->set(compact('userTypes'));
        $this->set('_serialize', ['userTypes']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $userType = $this->UserTypes->newEntity();
        if ($this->request->is('post')) {
            $userType = $this->UserTypes->patchEntity($userType, $this->request->getData());
            if ($this->UserTypes->save($userType)) {
                $this->Flash->success(__('The user type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user type could not be saved. Please, try again.'));
        }
        $this->set(compact('userType'));
        $this->set('_serialize', ['userType']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User Type id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $userType = $this->UserTypes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $userType = $this->UserTypes->patchEntity($userType, $this->request->getData());
            if ($this->UserTypes->save($userType)) {
                $this->Flash->success(__('The user type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user type could not be saved. Please, try again.'));
        }
        $this->set(compact('userType'));
        $this->set('_serialize', ['userType']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User Type id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $userType = $this->UserTypes->get($id);
        
        $msg = 'archived';
        if($userType->active){
            $userType->active = 0;
        }else{
            $userType->active = 1;
            $msg = 'restored';
        }
        
        if ($this->UserTypes->save($userType)) {
            $this->Flash->success(__('The user type has been deleted.'));
        } else {
            $this->Flash->error(__('The user type could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
