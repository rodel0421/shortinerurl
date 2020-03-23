<?php
namespace App\Controller\Rep;

use App\Controller\Rep\AppController;
use Cake\Datasource\ConnectionManager;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
    
    public function index()
    {   
        $contain = [];
    	
    	$conditions = array();
    	
    	$alt = [];
    	
    	$conditions = $this->buildConditions($this->Users,$alt);
                
        if($this->request->query('department_id')){
            $user_ids = $this->Users->DepartmentsUsers->find()
                    ->select('user_id')
                    ->contain([])
                    ->where(['department_id'=>$this->request->query('department_id')])
                    ->extract('user_id')->toArray();
            
            $this->request->data['department_id'] = $this->request->query('department_id');
            if(!empty($user_ids)){
                $conditions['Users.id IN'] = $user_ids;
            }else{
                $conditions['Users.id'] = 0;
            }
            
        }
        
        $users = $this->Users->find()
                ->select([
                    'user_id'=>'id',
                    'group_id','facility_id',
                    'account_type','provider',
                    'admin_only','active','disabled',
                    'send_alerts','account_verified',
                    'created','modified'
                ])
                ->contain($contain)
                ->where($conditions)->toArray();

        $this->set(compact('users'));
        $this->set('_serialize', 'users');
        //
    }


    public function departments()
    {   
        $connection = ConnectionManager::get('default');
        $departments_users = $connection->execute('SELECT * FROM departments_users')
            ->fetchAll('assoc');

        $this->set(compact('departments_users'));
        $this->set('_serialize', 'departments_users');
    }

}
