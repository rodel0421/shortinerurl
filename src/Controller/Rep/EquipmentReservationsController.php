<?php
namespace App\Controller\Rep;

use App\Controller\Rep\AppController;

/**
 * EquipmentReservations Controller
 *
 * @property \App\Model\Table\EquipmentReservationsTable $EquipmentReservations
 */
class EquipmentReservationsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $contain = ['Equipment'=>[
            'fields'=>['facility_id','active']]];
    	
    	$conditions = array();
        $userView = false;
    	
    	$alt = ['Equipment.title'=>'Equipment.title'];
        
    	$conditions = $this->buildConditions($this->EquipmentReservations,$alt);
        
        if($this->facility_id()){
            $conditions['Equipment.facility_id']=$this->facility_id();
        }
        
        $equipmentReservations = $this->EquipmentReservations->find()
                ->select([
                    'equipment_reservation_id'=>'EquipmentReservations.id',
                    'equipment_id',
                    'user_id',
                    'table',
                    'tableid',
                    'type',
                    'notes',
                    'qty',
                    'start',
                    'end',
                    'all_day',
                    'approved',
                    'returned',
                    'created',
                    'modified',
                    'date'=>"DATE_FORMAT(`EquipmentReservations`.`start`, '%Y-%m-%d')",
                    'days'=>'(ABS(DATEDIFF(`EquipmentReservations`.`end`, `EquipmentReservations`.`start`)) + 1)'
                    ])
                ->contain($contain)
                ->where($conditions)->toArray();
        
        // if(empty($equipmentReservations)){
        //     $equipmentReservations = [[                
        //         'equipment_reservation_id'=>null,
        //         'equipment_id'=>null,
        //         'user_id'=>null,
        //         'table'=>null,
        //         'tableid'=>null,
        //         'type'=>null,
        //         'notes'=>null,
        //         'qty'=>null,
        //         'start'=>null,
        //         'end'=>null,
        //         'all_day'=>null,
        //         'approved'=>null,
        //         'returned'=>null,
        //         'created'=>null,
        //         'modified'=>null,
        //         'date'=>null,
        //         'days'=>null,
        //         'equipment'=>[
        //             'facility_id'=>null,
        //             'active'=>null
        //         ],
        //     ]];
        // }

        $this->set(compact('equipmentReservations'));
        $this->set('_serialize', 'equipmentReservations');
        
    }

}
