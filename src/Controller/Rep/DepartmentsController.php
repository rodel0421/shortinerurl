<?php
namespace App\Controller\Rep;

use App\Controller\Rep\AppController;

/**
 * Departments Controller
 *
 * @property \App\Model\Table\DepartmentsTable $Departments
 */
class DepartmentsController extends AppController
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
    	
    	$alt = [];
    	
    	$conditions = $this->buildConditions($this->Departments,$alt);
    	        
        $departments = $this->Departments->find()
                ->select([
                    'department_id'=>'id',
                    'name',
                    'description',
                    'active',
                    'created',
                    'modified'
                ])
                ->contain($contain)
                ->where($conditions)->toArray();

        $this->set(compact('departments'));
        $this->set('_serialize', 'departments');
        
    }

}
