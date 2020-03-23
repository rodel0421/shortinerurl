<?php

namespace App\Shell;

use Cake\Console\Shell;
use Cake\I18n\Time;
use Cake\Mailer\Email;
use Cake\Routing\Router;
use Cake\Datasource\ConnectionManager;


class DatabaseShell extends Shell
{
//sudo crontab -u www-data -e
// /var/www/sites/boatndive/bin/cake Notification
//     sudo -u www-data bin/cake Notification

    public function initialize()
    {
        parent::initialize();
        //$this->loadModel('');
        Time::$defaultLocale = 'en_AU';
	    Time::setToStringFormat('dd/MM/yyyy');
    }
    
    public function main() {
        $this->out('Database Shell');
    }
    
    public function update(){
        $this->update1();
        
        $this->update2();
    }
    
    public function update1(){
        $this->out('update1 - will take the database schema from version 1 to Inital version');
        
        $connection = ConnectionManager::get('default');
        
        
        //Check if equipment type exists and update
        $this->loadModel('EquipmentTypes');
        $equipmentType = $this->EquipmentTypes->find('all')
                ->where(['title'=>'Boat'])->first();
        
        $customVars = '[{"custom_name":"Size","custom_type":"text","custom_help":"","custom_required":false},
{"custom_name":"Registration Number","custom_type":"text","custom_help":"","custom_required":false},
{"custom_name":"Number of Persons","custom_type":"number","custom_help":"","custom_required":false},
{"custom_name":"Area of Operation","custom_type":"text","custom_help":"","custom_required":false},
{"custom_name":"Contact","custom_type":"text","custom_help":"","custom_required":false},
{"custom_name":"Contact Email","custom_type":"text","custom_help":"","custom_required":false},
{"custom_name":"Storage","custom_type":"text","custom_help":"","custom_required":false},
{"custom_name":"Motor","custom_type":"text","custom_help":"","custom_required":false},
{"custom_name":"Motor HP","custom_type":"text","custom_help":"","custom_required":false},
{"custom_name":"Motor Year","custom_type":"text","custom_help":"","custom_required":false},
{"custom_name":"Motor Serial","custom_type":"text","custom_help":"","custom_required":false},
{"custom_name":"Motor Purchased","custom_type":"text","custom_help":"","custom_required":false},
{"custom_name":"Motor Cost","custom_type":"number","custom_help":"","custom_required":false},
{"custom_name":"Motor Asset","custom_type":"text","custom_help":"","custom_required":false},
{"custom_name":"Trailer","custom_type":"text","custom_help":"","custom_required":false},
{"custom_name":"Trailer Rego","custom_type":"text","custom_help":"","custom_required":false},
{"custom_name":"Trailer Purchased","custom_type":"date","custom_help":"","custom_required":false},
{"custom_name":"Trailer VIN","custom_type":"text","custom_help":"","custom_required":false},
{"custom_name":"Trailer Cost","custom_type":"number","custom_help":"","custom_required":false},
{"custom_name":"Trailer Asset","custom_type":"text","custom_help":"","custom_required":false},
{"custom_name":"In Service","custom_type":"number","custom_help":"","custom_required":false}]';
        
        if(!$equipmentType){
            //Create
            $equipmentType = $this->EquipmentTypes->newEntity([
                'title'=>'Boat',
                'category'=>'Boat',
                'data'=>$customVars,
                'serviceable'=>true,
                'track_usage'=>true,
                'user_equipment'=>false,
                'active'=>true
            ]);
        }else{
            $equipmentType->data = $customVars;
        }
        
        if(!$this->EquipmentTypes->save($equipmentType)){
            $this->out('Error saving equipment type');
            debug($equipmentType-getErrors());
            
        }else{
            $this->out('Updated boat type');
        }
        
        
        //Get facility
        $this->loadModel('Facilities');
        $facility = $this->Facilities->find('all',['conditions'=>['active'=>true]])->first();
      
        
        $query = "select * from boats;";
        $boats = $connection->execute($query)->fetchAll('assoc');
        
        //debug($boats);
        //TODO: BoatDates, Boat documents, Boat logs
        //Work out facility
        $good = 0;
        $bad = 0;
        $errors = [];
        $this->loadModel('Equipment');
        foreach($boats as $boat){
            
            //Check for existing import
            $equipment = $this->Equipment->find('all')->
                    where(['make'=>'Insert ID','model'=>$boat['id']])->first();
            
            if(!$equipment){
                $equipment = $this->Equipment->newEntity();
            }else{
                //continue;//Do not update
            }
            
            $equipment = $this->Equipment->patchEntity($equipment,[
                'model'=>$boat['id'],
                'make'=>'Insert ID', 
                'title'=>($boat['name'])?$boat['name']:' ', 
                'equipment_type_id'=>$equipmentType->id, 
                'department_id'=>$boat['department_id'], 
                'asset'=>$boat['asset'], 
                'serial'=>$boat['serial'], 
                'part_number'=>$boat['registration_number'], 
                'purchased'=>(preg_match('/^[1-2]\d{3}$/', $boat['purchased']))?$boat['purchased'].'-01-01':null, 
                'cost'=>floatval(preg_replace('/[^\d\.]/', '', $boat['cost'])), 
                'cost_centre'=>$boat['charge_code'], 
                'next_service'=>$boat['next_expiring'], 
                'usage_hours'=>$boat['motor_hours'], 
                'picture_url'=>($boat['image_url'])?'/upload/ids/'.$boat['image_url']:null, 
                'for_hire'=>1, 
                'qty'=>1, 
                'notes'=>$boat['description'], 
                'active'=>$boat['in_service'], 
                'created'=>$boat['created'], 
                'modified'=>$boat['modified']
            ],['validate'=>'import']);
            
            if($facility){
                $equipment->facility_id = $facility->id;
            }
            
            $custom = [
                'Size'=>$boat['size'],
                'Registration Number'=>$boat['registration_number'],
                'Number of Persons'=>$boat['number_of_persons'],
                'Area of Operation'=>$boat['area_of_operation'],
                'Contact'=>$boat['contact'],
                'Contact Email'=>$boat['contact_email'],
                'Storage'=>$boat['storage'],
                'Motor'=>$boat['motor'],
                'Motor HP'=>$boat['motor_hp'],
                'Motor Year'=>$boat['motor_year'],
                'Motor Serial'=>$boat['motor_serial'],
                'Motor Purchased'=>$boat['motor_purchased'],
                'Motor Cost'=>floatval(preg_replace('/[^\d\.]/', '', $boat['motor_cost'])),
                'Motor Asset'=>$boat['motor_asset'],
                'Trailer'=>$boat['trailer'],
                'Trailer Rego'=>$boat['trailer_rego'],
                'Trailer Purchased'=>$boat['trailer_purchased'],
                'Trailer VIN'=>$boat['trailer_vin'],
                'Trailer Cost'=>$boat['trailer_cost'],
                'Trailer Asset'=>$boat['trailer_asset']
            ];
            
            $equipment->type_data = json_encode($custom);
            
            if($this->Equipment->save($equipment,['validate'=>'import'])){
                $good++;
            }else{
                $bad++;
                $errors[] = ['Errors'=>$equipment->getErrors(),'data'=>$equipment->invalid()];
                
            }
            
            $query = "select * from boat_dates where boat_id = {$boat['id']};";
            $boat_dates = $connection->execute($query)->fetchAll('assoc');
            
            
            $this->loadModel('EquipmentLogs');
            $this->EquipmentLogs->removeBehavior('Josegonzalez/Upload.Upload');
            /*
            $this->EquipmentLogs->rules->add($this->EquipmentLogs->rules->isUnique(
                    ['equipment_id', 'created','modified'],
                    'This entry has already been migrated.'
                ));*/
            
            $equipment_logs = [];
            foreach($boat_dates as $boat_date){
                $equipment_logs[] = $this->EquipmentLogs->newEntity([
                    'equipment_id'=> $equipment->id,
                    'type'=>'Reminder',
                    'notes'=> $boat_date['title'],
                    'alert_date'=>$boat_date['date'],
                    'created'=> $boat_date['created'],
                    'modified'=>$boat_date['modified'],
                    'active'=>true
                ],['validate'=>'import']
                        );
            }
            
            $query = "select * from boat_documents where boat_id = {$boat['id']};";
            $boat_documents = $connection->execute($query)->fetchAll('assoc');
            
            foreach($boat_documents as $boat_document){
                
                $equipment_logs[] = $this->EquipmentLogs->newEntity([
                    'equipment_id'=> $equipment->id,
                    'type'=>'Document',
                    'notes'=>'',
                    'file_name'=> $boat_document['name'],
                    'file_url'=>($boat_document['file_url'])?'/upload'.$boat_document['file_url']:null,
                    'file_type'=>$boat_document['mime_type'],
                    'file_size'=>$boat_document['filesize'],
                    'file_ext'=>$boat_document['extension'],
                    'created'=> $boat_document['created'],
                    'modified'=>$boat_document['created'],
                    'active'=>!$boat_document['archived']
                ],['validate'=>'import']);
                
            }
            
            $query = "select * from boat_logs where boat_id = {$boat['id']};";
            $boat_logs = $connection->execute($query)->fetchAll('assoc');
            
            foreach($boat_logs as $boat_log){
                $equipment_logs[] = $this->EquipmentLogs->newEntity([
                    'equipment_id'=> $equipment->id,
                    'type'=> ($boat_log['type'] == 'Service') ? 'Service' :'Note',
                    'notes'=>$boat_log['notes'],
                    'date'=>$boat_log['date'],
                    'user_id'=> $boat_log['user_id'],
                    'file_name'=> 'Attachment',
                    'file_url'=>($boat_log['file_url'])?'/upload'.$boat_log['file_url']:null,
                    'file_type'=>$boat_log['file_type'],
                    'file_size'=>$boat_log['file_size'],
                    'file_ext'=>$boat_log['file_ext'],
                    'created'=> $boat_log['created'],
                    'modified'=>$boat_log['modified'],
                    'active'=>true
                ],['validate'=>'import']);
            }
            
            foreach ($equipment_logs as $entity) {
                if($this->Equipment->EquipmentLogs->save($entity,['validate'=>'import'])){
                    $good++;
                }else{
                    $bad++;
                    $errors[] = [
                        'Type'=>'equipment_logs',
                        'equipment_id'=>$entity->equipment_id,
                        'Errors'=>$entity->getErrors(),
                        'data'=>$entity->invalid()];
                }
            }
            
        }
        
        debug(compact('good','bad','errors'));
    }
    
    function update2(){
        $this->out('update2 - Trip Personnel');
        
        $good = 0;
        $bad = 0;
        $errors = [];
        $this->loadModel('TripPersonnel');
        
        $personnel = $this->TripPersonnel->find()
                ->contain(['Trips'=>['fields'=>['id','boating','diving']]])
                ->where(['TripPersonnel.details IS NULL']);
        
        
        foreach($personnel as $entity){
            $custom = [];
            if($entity->has('trip') && $entity->trip->diving){
                $duties = [];
                
                if($entity->diver) $duties[] = 'Diver';
                if($entity->dive_supervisor) $duties[] = 'Surface Dive Supervisor';
                if($entity->snorkel_only) $duties[] = 'Snorkel only';
                
                $custom = [
                    'Dive Medical Date'=>$entity->dive_medical,
                    'Last Dive'=>$entity->last_dive,
                    'Dive Depth'=>$entity->last_dive_depth,
                    'Personal'=>$entity->own_gear,
                    'Hire'=>$entity->hire_gear,
                    'Lab'=>$entity->lab_gear
                ];
            }
            
            if($entity->has('trip') && $entity->trip->boating){
                if($entity->boat_driver) $duties[] = 'Boat Driver';
            }
            
            $entity->duties = $duties;
            
            $entity->details = json_encode($custom);
            
            if($this->TripPersonnel->save($entity)){
                    $good++;
                }else{
                    $bad++;
                    $errors[] = [
                        'Type'=>'TripPersonnel',
                        'id'=>$entity->id,
                        'Errors'=>$entity->getErrors(),
                        'data'=>$entity->invalid()];
                }
        }
        
        debug(compact('good','bad','errors'));
    }
     
}
