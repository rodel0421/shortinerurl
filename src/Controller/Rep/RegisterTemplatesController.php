<?php
namespace App\Controller\Rep;

use App\Controller\Rep\AppController;

/**
 * RegisterTemplates Controller
 *
 * @property \App\Model\Table\RegisterTemplatesTable $RegisterTemplates
 */
class RegisterTemplatesController extends AppController
{
    

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
                
        $registerTemplates = $this->RegisterTemplates->find()
                ->select([
                    'register_template_id'=>'id',
                    'name','active','created','modified'])
                ->contain($contain)
                ->where($conditions)->toArray();

        $this->set(compact('registerTemplates'));
        $this->set('_serialize', 'registerTemplates');
        
    }

}
