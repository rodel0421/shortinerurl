<?php
namespace App\Controller\Rep;

use App\Controller\Rep\AppController;

/**
 * RegisterClasses Controller
 *
 * @property \App\Model\Table\RegisterClassesTable $RegisterClasses
 */
class RegisterClassesController extends AppController
{
    public function index()
    {
        $contain = [];
    	
    	$conditions = [];
    	
    	$alt = [];
        
    	$conditions = $this->buildConditions($this->RegisterClasses,$alt);
                
        $registerClasses = $this->RegisterClasses->find()
                ->select([
                    'register_class_id'=>'id',
                    'register_template_id',
                    'title',
                    'short_hand',
                    'description',
                    'icon',
                    'active',
                    'created',
                    'modified'
                ])
                ->contain($contain)
                ->where($conditions)->toArray();

        $this->set(compact('registerClasses'));
        $this->set('_serialize', 'registerClasses');
        
    }
}
