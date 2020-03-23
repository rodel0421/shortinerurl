<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Routing\Router;

/**
 * Alerts Controller
 * alert controller
 * 
 * @property \App\Model\Table\AlertsTable $Alerts
 */
class AlertsController extends AppController
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
        
        // all have all
        return true;
    }
    
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $contain = ['Users'];
    	
    	$conditions = [];
        $userView = false;
    	
    	$alt = ['Users.name'=>'Users.name'];
        
    	$conditions = $this->buildConditions($this->Alerts,$alt);
        
        $group = $this->Auth->user('group_id');
        if(!$group || $group > 3){//4 	staff and below lock to own account
            $user_id = $this->Auth->user('id');
            $userView = true;
        }else{
            
            $user_id = ($this->request->query('user_id'))?$this->request->query('user_id'): $this->Auth->user('id');
        }
        
        $user = $this->Alerts->Users->get($user_id,['fields'=>['id','name'],'contain'=>[]]);
        
        $conditions['Alerts.user_id'] = $user_id;
        
        if(!$this->request->query('archived')){
            $conditions['Alerts.active']=1;
        }else{
            $conditions['Alerts.active']=0;
        }
        
        $this->paginate = [
            'contain' => $contain,
            'conditions'=>$conditions,
            'limit' => 30,
            'order' => [
                'Alerts.id' => 'desc'//recent first
            ]
        ];
        
        $alerts = $this->paginate($this->Alerts);

        $this->set(compact('alerts','userView','user'));
    }

    /**
     * View method
     *
     * @param string|null $id Alert id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $alert = $this->Alerts->get($id, [
            'contain' => ['Users']
        ]);
        
        if(empty($alert->ack) && $alert->user_id == $this->Auth->user('id')){
            $alert->ack = date('Y-m-d H:i:s');
            $this->Alerts->save($alert);
        }
        
        $link = $alert->link;
        if(!preg_match("@^http://@i",$link)){
            $link =  Router::url('/', true) . $link;
        }
        
        return $this->redirect($link);
    }

    /**
     * Delete method
     *
     * @param string|null $id Alert id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $alert = $this->Alerts->get($id);
        
        $group = $this->Auth->user('group_id');
        //Not RO or better
        if(!$group || $group >= 3){//Staff and below lock to own account
            //If not owner reject
            if($alert->user_id != $this->Auth->user('id')){
                $this->Flash->error(__('You do not have access to this record.'));
                return $this->redirect($this->referer());
            }
        }

        $msg = 'archived';
        if($alert->active){
            $alert->active = 0;
        }else{
            $alert->active = 1;
            $msg = 'restored';
        }
        
        if ($this->Alerts->save($alert)) {
            $this->Flash->success(__('The alert has been '.$msg.'.'));
        } else {
            $this->Flash->error(__('The alert could not be '.$msg.'. Please, try again.'));
        }

        return $this->redirect($this->referer());
    }
}
