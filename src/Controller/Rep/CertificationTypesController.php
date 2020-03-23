<?php
namespace App\Controller\Rep;

use App\Controller\Rep\AppController;

/**
 * CertificationTypes Controller
 *
 * @property \App\Model\Table\CertificationTypesTable $CertificationTypes
 */
class CertificationTypesController extends AppController
{

    
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $contain = [
            'CertificationClasses'=>[
                'fields'=>[
                    'name',
                    'short_hand',
                    'description',
                    'icon'
                ]
            ]
            ];
    	
    	$conditions = [];
    	
    	$alt = [];
        
    	$conditions = $this->buildConditions($this->CertificationTypes,$alt);
                        
        $certificationTypes = $this->CertificationTypes->find()
                ->select([
                    'certification_type_id'=>'CertificationTypes.id',
                    'category',
                    'type',
                    'name',
                    'description',
                    'active',
                    'created',
                    'certification_class_id',
                    'modified'
                ])
                ->contain($contain)
                ->where($conditions)->toArray();

        $this->set(compact('certificationTypes'));
        $this->set('_serialize', 'certificationTypes');
    }
}
