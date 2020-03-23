<?php
namespace App\Controller\Rep;

use App\Controller\Rep\AppController;

/**
 * EquipmentTypes Controller
 *
 * @property \App\Model\Table\EquipmentTypesTable $EquipmentTypes
 */
class EquipmentTypesController extends AppController
{

    public function index()
    {
        $contain = [];
    	
    	$conditions = array();
    	
    	$alt = [];
        
    	$conditions = $this->buildConditions($this->EquipmentTypes,$alt);
                
        $equipmentTypes = $this->EquipmentTypes->find()
                ->select([
                    'equipment_type_id'=>'id',
                    'title',
                    'category','serviceable','track_usage',
                    'user_equipment',
                    'hourly_booking','auto_approval',
                    'active','created','modified'])
                ->contain($contain)
                ->where($conditions)->toArray();

        $this->set(compact('equipmentTypes'));
        $this->set('_serialize', 'equipmentTypes');
        
    }

}
