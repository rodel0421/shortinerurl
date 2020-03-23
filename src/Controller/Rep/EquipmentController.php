<?php
namespace App\Controller\Rep;

use App\Controller\Rep\AppController;
use Cake\Utility\Hash;

/**
 * Equipment Controller
 *
 * @property \App\Model\Table\EquipmentTable $Equipment
 */
class EquipmentController extends AppController
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
        
    	$conditions = $this->buildConditions($this->Equipment,$alt);
                
        if($this->facility_id()){
            $conditions['Equipment.facility_id']=$this->facility_id();
        }else{
            $conditions[]='Equipment.facility_id IS NULL';
        }
        
        if($this->request->query('service')){
            $conditions[] = 'Equipment.next_service IS NOT NULL';
            $conditions['Equipment.next_service <='] = date("Y-m-d", strtotime($this->request->query('service')));
        }
        
        if($this->request->query('search')){
            $conditions['OR']['Equipment.title LIKE']='%'.$this->request->query('search').'%';
            $conditions['OR']['Equipment.make LIKE']='%'.$this->request->query('search').'%';
            $conditions['OR']['Equipment.model LIKE']='%'.$this->request->query('search').'%';
            $conditions['OR']['Equipment.asset LIKE']='%'.$this->request->query('search').'%';
        }
        
        
        
        $equipment = $this->Equipment->find()
                ->contain($contain)
                ->where($conditions);
        
        if(!$this->request->query('full')){
            $equipment->select([
               'equipment_id'=>'id',
                'facility_id','title','equipment_type_id','department_id','picture_url','asset','make','model','serial','part_number',
            'purchased','issued_to','cost','cost_centre','depreciated_over_years','user_id','last_service','next_service','next_alert','usage_hours','usage_km',
            'for_hire','qty','active','status','alert_status','status_date','created','modified']);
        }
        
        $equipment->toArray();
        
        $this->set(compact('equipment'));
        $this->set('_serialize', 'equipment');
        
    }

}
