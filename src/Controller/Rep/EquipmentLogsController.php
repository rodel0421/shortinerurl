<?php
namespace App\Controller\Rep;

use App\Controller\Rep\AppController;

/**
 * EquipmentLogs Controller
 *
 * @property \App\Model\Table\EquipmentLogsTable $EquipmentLogs
 */
class EquipmentLogsController extends AppController
{

    public function index()
    {
        $contain = ['Equipment'];
        $alt = [];
        
    	$conditions = $this->buildConditions($this->EquipmentLogs,$alt);
        
        $conditions['Equipment.active']=1;
        if(!$this->request->query('archived')){
            $conditions['EquipmentLogs.active']=1;
        }else{
            $conditions['EquipmentLogs.active']=0;
        }
        
        
        if(isset($this->request->query['date_filter'])){
            $days = (int) $this->request->query('date_filter');
            $conditions['EquipmentLogs.alert_date <='] = date('Y-m-d', strtotime('+ $days Days'));
            $this->request->data['date_filter'] = $days;
        }
        
        if($this->facility_id()){
            $conditions['Equipment.facility_id']=$this->facility_id();
        }
            
        $equipmentLogs = $this->EquipmentLogs->find()
                ->select([
                    'equipment_log_id' => 'EquipmentLogs.id',
                    'equipment_id',
                    'user_id',
                    'type',
                    'date',
                    'alert_date',
                    'cost',
                    'file_url',
                    'file_name',
                    'file_type',
                    'file_ext',
                    'file_size',
                    'public',
                    'active',
                    'created',
                    'modified'
                    ])
                ->contain($contain)
                ->where($conditions)->toArray();

        $this->set(compact('equipmentLogs'));
        $this->set('_serialize', 'equipmentLogs');
        
    }
    

}
