<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Utility\Security;
use Cake\Datasource\ConnectionManager;

/**
 * Equipment Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Facilities
 * @property \Cake\ORM\Association\BelongsTo $EquipmentTypes
 * @property \Cake\ORM\Association\BelongsTo $Departments
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\HasMany $EquipmentLogs
 * @property \Cake\ORM\Association\HasMany $ServiceLogs
 *
 * @method \App\Model\Entity\Equipment get($primaryKey, $options = [])
 * @method \App\Model\Entity\Equipment newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Equipment[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Equipment|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Equipment patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Equipment[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Equipment findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */

function equipHash($data,$field){
    $currentName = $data['name'];
    // return random int so browser does not cache profile image if changed in same date.
    return rand(1000,9999) . Security::hash($currentName.date('YmdHHMMII'), 'sha1', true).substr($currentName,strrpos($currentName,"."));
}
class EquipmentTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('equipment');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('EquipmentTypes', [
            'foreignKey' => 'equipment_type_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Departments', [
            'foreignKey' => 'department_id'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'finder'=>'nameonly'
        ]);
        $this->hasMany('EquipmentLogs', [
            'foreignKey' => 'equipment_id',
            'conditions' => ['EquipmentLogs.active'=>1]
        ]);
        
        $this->belongsToMany('RelatedEquipment', [
            'className' => 'Equipment',
            'foreignKey' => 'related_equipment',
            'targetForeignKey' => 'equipment_id',
            'joinTable' => 'equipment_links'
        ]);
        
        $this->belongsToMany('RelatedToEquipment', [
            'className' => 'Equipment',
            'foreignKey' => 'equipment_id',
            'targetForeignKey' => 'related_equipment',
            'joinTable' => 'equipment_links'
        ]);
        
        $this->addBehavior('ChrisShick/CakePHP3HtmlPurifier.HtmlPurifier', [
            'fields'=>['notes'],
            'config'=>[
                'HTML'=>[
                    'TidyLevel' => 'heavy'
                ],
                'AutoFormat'=>[
                    'RemoveSpansWithoutAttributes' => true,
                    'RemoveEmpty' => true],
                'Cache'=>[
                'SerializerPath'=>TMP]
                ]
        ]);
        
        $this->addBehavior('Josegonzalez/Upload.Upload', [
            'profile_url'=>[
                'path'=>'secupload{DS}equipment{DS}{field-value:id}{DS}',
                'nameCallback' => '\App\Model\Table\equipHash'
            ],
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('title', 'create')
            ->notEmpty('title');
        
        $validator
            ->integer('equipment_type_id')
            ->requirePresence('equipment_type_id', 'create')
            ->notEmpty('equipment_type_id');

        $validator
            ->allowEmpty('asset');

        $validator
            ->allowEmpty('make');

        $validator
            ->allowEmpty('model');

        $validator
            ->allowEmpty('serial');

        $validator
            ->allowEmpty('part_number');

        $validator
            ->allowEmpty('notes');

        $validator
            ->date('purchased')
            ->allowEmpty('purchased');

        $validator
            ->allowEmpty('type_data');

        $validator
            ->allowEmpty('issued_to');

        $validator
            ->numeric('cost')
            ->allowEmpty('cost');

        $validator
            ->allowEmpty('cost_centre');

        $validator
            ->integer('depreciated_over_years')
            ->allowEmpty('depreciated_over_years');

        $validator
            ->date('last_service')
            ->allowEmpty('last_service');

        $validator
            ->date('next_service')
            ->allowEmpty('next_service');
        
        $validator
            ->integer('usage_km')
            ->allowEmpty('usage_km');
        
        $validator
            ->integer('usage_hours')
            ->allowEmpty('usage_hours');

        $validator
            ->boolean('active')
            ->allowEmpty('active');
        
        $validator
            ->boolean('for_hire')
            ->allowEmpty('for_hire');

        $validator
            ->integer('qty')
            ->allowEmpty('qty');

        $validator
            ->integer('status')
            ->allowEmpty('status');

        $validator
            ->date('status_date')
            ->allowEmpty('status_date');
        
        
        $validator->provider('upload', \Josegonzalez\Upload\Validation\UploadValidation::class);
        
        $validator
            ->allowEmpty('picture_url')
            ->add('picture_url', [
                'validExtension' => [
                    'last' => true,
                    'rule' => ['extension',['gif', 'jpeg', 'png', 'jpg']],
                    'provider' => 'table',
                    'message' => __('These files extension are allowed: .gif, .jpg, .png, .jpeg')
                ],
                'file'=>[
                    'rule' => 'isFileUpload',
                    'message' => 'There was no file found to upload',
                    'provider' => 'upload',
                    'last' => true,
                ],
                'filesize'=>[
                    'last' => true,
                    'rule' => ['isBelowMaxSize', 512000],
                    'message' => 'The image is too large',
                    'provider' => 'upload'
                ]
            ]);

        return $validator;
    }
    
    public function validationImport(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('title', 'create')
            ->notEmpty('title');
        
        $validator
            ->integer('equipment_type_id')
            ->requirePresence('equipment_type_id', 'create')
            ->notEmpty('equipment_type_id');

        $validator
            ->allowEmpty('asset');

        $validator
            ->allowEmpty('make');

        $validator
            ->allowEmpty('model');

        $validator
            ->allowEmpty('serial');

        $validator
            ->allowEmpty('part_number');

        $validator
            ->allowEmpty('notes');

        $validator
            ->date('purchased')
            ->allowEmpty('purchased');

        $validator
            ->allowEmpty('type_data');

        $validator
            ->allowEmpty('issued_to');

        $validator
            ->numeric('cost')
            ->allowEmpty('cost');

        $validator
            ->numeric('hire_rate')
            ->allowEmpty('hire_rate');

        $validator
            ->add('location','maxLength' ,[
                'rule' => ['maxLength', 200],
                'message' => 'Must be less than 200 charecters long'
            ])
            ->allowEmpty('location');

        $validator
            ->allowEmpty('cost_centre');

        $validator
            ->integer('depreciated_over_years')
            ->allowEmpty('depreciated_over_years');

        $validator
            ->date('last_service')
            ->allowEmpty('last_service');

        $validator
            ->date('next_service')
            ->allowEmpty('next_service');
        
        $validator
            ->integer('usage_km')
            ->allowEmpty('usage_km');
        
        $validator
            ->integer('usage_hours')
            ->allowEmpty('usage_hours');

        $validator
            ->boolean('active')
            ->allowEmpty('active');
        
        $validator
            ->boolean('for_hire')
            ->allowEmpty('for_hire');

        $validator
            ->integer('qty')
            ->allowEmpty('qty');

        $validator
            ->integer('status')
            ->allowEmpty('status');

        $validator
            ->date('status_date')
            ->allowEmpty('status_date');
        
        return $validator;
    }
    
    public function beforeSave($event, $entity, $options)
    {
        if(!empty($entity->picture_url) && !is_array($entity->picture_url) && !empty($entity->id) &&
                strpos($entity->picture_url, '/upload/') === false){
            $entity->picture_url = '/upload/equipment/'.$entity->id.'/' . $entity->picture_url;
        }
    }
    
    public function afterSave($event, $entity, $options) {
        //debug($entity);
        //die();
        //Dont enter loop :)    
        if($entity->dirty('status_date') || $entity->active == 0){
            return true;
        }
        
        $connection = ConnectionManager::get('default');
        
        //Do service date
        $status = 4; //Start with error status
        //if expired
        if(!empty($entity->next_service)){
            //Expires greater than one month away
            
            if(method_exists ($entity->next_service,'format')){
                $next_service = $entity->next_service->format('Y-m-d');
            }else{
                $next_service = $entity->next_service;
            }
                
            if($next_service > date("Y-m-d", strtotime("+1 month"))){
                $status = 1; //Good
            }elseif($next_service > date("Y-m-d")){
                //Will expire in the next month
                $status = 2;
            }else{
                //Has expired already
                $status = 3;
            }
        }else{
            $status = 0; //Not expiring ever
        }
        //Set status
        $entity->status = $status;
        
        $status = 4; //Start with error status
        //Do notification dates
        //if no set
        if(!$entity->dirty('next_alert')){
            //get oldest expiry date
            $latest = $this->EquipmentLogs->find()
                    ->select(['id','alert_date','equipment_id'])
                    ->where(['alert_date IS NOT NULL','equipment_id'=>$entity->id,'active'=>true])
                    ->order(['alert_date'=>'asc'])->first();
            
            $entity->next_alert = isset($latest->alert_date) && !empty($latest->alert_date) ? $latest->alert_date : null;
        }
        
        //if expired
        if(!empty($entity->next_alert)){
            //Expires greater than one month away
            if($entity->next_alert->i18nFormat('yyyy-MM-dd') > date("Y-m-d", strtotime("+1 month"))){
                $status = 1; //Good
            }elseif($entity->next_alert->i18nFormat('yyyy-MM-dd') > date("Y-m-d")){
                //Will expire in the next month
                $status = 2;
            }else{
                //Has expired already
                $status = 3;
            }
        }else{
            $status = 0; //Not expiring ever
        }
        
        $entity->alert_status = $status;
        
        //set curr date
        $entity->status_date = date('Y-m-d H:i:s');
        
        $result = $this->save($entity);

        if(!empty($entity->user_id)){
            //Update user statuses
            $query = "INSERT INTO user_statuses (user_id, `status`, status_date, `type`, modified) 
                select * from (
                select c.user_id, max(c.`status`) as max_status, min(c.status_date) as min_date, 'Equipment' ,NOW()
                from equipment c
                where c.active = 1 AND c.user_id = :user_id AND c.status_date IS NOT NULL
                ) as s where s.user_id IS NOT NULL
                ON DUPLICATE KEY UPDATE `status`= s.max_status, status_date= s.min_date, modified=NOW();";

            $connection->execute($query,['user_id'=>$entity->user_id]);
        }
        
        return $result;
        
    }
    
    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['equipment_type_id'], 'EquipmentTypes'));
        $rules->add($rules->existsIn(['department_id'], 'Departments'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
    public static function extension($check, $extensions = ['gif', 'jpeg', 'png', 'jpg'])
    {
        if (is_array($check)) {
            if(isset($check['name'])){
                return static::extension($check['name'], $extensions);
            }
            
            return false;
        }
        $extension = strtolower(pathinfo($check, PATHINFO_EXTENSION));
        foreach ($extensions as $value) {
            if ($extension === strtolower($value)) {
                return true;
            }
        }

        return false;
    }
    
}
