<?php
namespace App\Controller\Rep;

use App\Controller\Rep\AppController;

/**
 * Registers Controller
 *
 * @property \App\Model\Table\RegistersTable $Registers
 */
class RegistersController extends AppController
{
    
    public function index()
    {
        $contain = [];
    	
    	$conditions = array();
    	
    	$alt = [];
        
    	$conditions = $this->buildConditions($this->Registers,$alt);
                  
        $registers = $this->Registers->find()
                ->contain($contain)
                ->where($conditions);
        
        if(!$this->request->query('full')){
            $registers->select([
            'register_id'=>'id','register_template_id','user_id','register_class_id',
            'department_id','status','active','cert_status','cert_status_date',
            'created','modified']);
        }
        
        $registers->toArray();
       
        $this->set(compact('registers'));
        $this->set('_serialize', 'registers');
        
    }

}
