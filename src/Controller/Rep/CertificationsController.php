<?php
namespace App\Controller\Rep;

use App\Controller\Rep\AppController;

/**
 * Certifications Controller
 *
 * @property \App\Model\Table\CertificationsTable $Certifications
 */
class CertificationsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $contain = [];
    	
    	$conditions = array();
        $userView = false;
    	
    	$alt = [];
        
    	$conditions = $this->buildConditions($this->Certifications,$alt);
        
        $group = $this->Auth->user('group_id');
        if(!$group || $group > 3){//4 	staff and below lock to own account
            $conditions['user_id'] = $this->Auth->user('id');
            $userView = true;
        }
        
        if($this->request->query('department_id')){
            $user_ids = $this->Certifications->Users->DepartmentsUsers->find()
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
        
        $certifications = $this->Certifications->find()
                ->select([
                    'certification_id'=>'id',
                    'user_id',
                    'certification_type_id','issuer','issued',
                    'expires',
                    'validated_by','validated_date','valid','mime_type',
                    'filesize','active','status','status_date',
                    'created','modified'])
                ->contain($contain)
                ->where($conditions)->toArray();
        
        
        $this->set('certifications',$certifications);
        $this->set('_serialize', 'certifications');
    }
}