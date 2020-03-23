<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Utility\Security;
//use Cake\Log\Log;

/**
 * EquipmentLogs Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Equipment
 * @property \Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\EquipmentLog get($primaryKey, $options = [])
 * @method \App\Model\Entity\EquipmentLog newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\EquipmentLog[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\EquipmentLog|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EquipmentLog patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\EquipmentLog[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\EquipmentLog findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
function equipDocHash($data,$field){
    $currentName = $data['name'];
    // return random int so browser does not cache profile image if changed in same date.
    return rand(1000,9999) . Security::hash($currentName.date('YmdHHMMII'), 'sha1', true).substr($currentName,strrpos($currentName,"."));
}
class EquipmentLogsTable extends Table
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

        $this->table('equipment_logs');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Equipment', [
            'foreignKey' => 'equipment_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id'
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
            'file_url'=>[
                'path'=>'secupload{DS}equipment{DS}{field-value:equipment_id}{DS}',
                'fields' => [
                    'size' => 'file_size',
                    'type' => 'file_type'
                ],
                'nameCallback' => '\App\Model\Table\equipDocHash'
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
            ->requirePresence('type', 'create')
            ->notEmpty('type');

        $validator
            ->allowEmpty('notes');

        $validator
            ->date('date')
            ->allowEmpty('date');
        
        
        $validator
            ->date('alert_date')
            ->allowEmpty('alert_date');
        
        $validator
            ->date('last_service')
            ->notBlank('last_service');

        $validator
            ->date('next_service')
            ->allowEmpty('next_service');

        
        $validator
            ->numeric('cost')
            ->allowEmpty('cost');
        
        
        $validator
            ->numeric('usage_hours')
            ->allowEmpty('usage_hours');
        
        $validator
            ->numeric('usage_km')
            ->allowEmpty('usage_km');

        $validator
            ->allowEmpty('file_type');

        $validator
            ->allowEmpty('file_ext');

        $validator
            ->allowEmpty('file_size');
        
        $validator->provider('upload', \Josegonzalez\Upload\Validation\UploadValidation::class);
        
        $validator
            ->allowEmpty('file_url')
            ->add('file_url', [
                'validExtension' => [
                    'last' => true,
                    'rule' => ['extension',['gif', 'jpeg', 'png', 'jpg','csv','pdf']],
                    'provider' => 'table',
                    'message' => __('These files extension are allowed: .gif, .jpg, .png, .jpeg, .pdf, .csv')
                ],
                'file'=>[
                    'rule' => 'isFileUpload',
                    'message' => 'There was no file found to upload',
                    'provider' => 'upload',
                    'last' => true,
                ],
                'filesize'=>[
                    'last' => true,
                    'rule' => ['isBelowMaxSize', 5242880], //5MB
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
            ->requirePresence('type', 'create')
            ->notEmpty('type');

        $validator
            ->allowEmpty('notes');

        $validator
            ->date('date')
            ->allowEmpty('date');
        
        
        $validator
            ->date('alert_date')
            ->allowEmpty('alert_date');
        
        $validator
            ->date('last_service')
            ->notBlank('last_service');

        $validator
            ->date('next_service')
            ->allowEmpty('next_service');

        
        $validator
            ->numeric('cost')
            ->allowEmpty('cost');
        
        
        $validator
            ->numeric('usage_hours')
            ->allowEmpty('usage_hours');
        
        $validator
            ->numeric('usage_km')
            ->allowEmpty('usage_km');

        $validator
            ->allowEmpty('file_type');

        $validator
            ->allowEmpty('file_ext');

        $validator
            ->allowEmpty('file_size');
        
        return $validator;
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
    
    public function beforeSave($event, $entity, $options){
        
        if(!empty($entity->file_url) && !empty($entity->equipment_id) &&
                strpos($entity->file_url, '/upload/') === false){
            
            $entity->file_ext = strtolower(substr($entity->file_url,strrpos($entity->file_url,".")+1));
            
            $entity->file_url = '/upload/equipment/'.$entity->equipment_id.'/' . $entity->file_url;
        }
        
        if(empty($entity->file_name)){
            $uploaded_file = $entity->getOriginal('file_url');
            if(isset($uploaded_file['name'])){
                $entity->file_name = $uploaded_file['name'];
            }
        }
        
        //This is for the import
        if($entity->isNew() && !empty($entity->file_url)){
            $entity->dirty('file_url',true);
        }        
                
    }
    
    
    public function afterSave($event, $entity, $options) {  
        
        if(($entity->dirty('alert_date') || $entity->dirty('active'))){
            //save parent
            $equipment = $this->Equipment->get($entity->equipment_id,['contain'=>[],'fields'=>[
                'id','next_alert','status_date','user_id','next_service','active'
                ]]);
            
            if(empty($equipment->next_alert) || (!empty($entity->alert_date) && $equipment->next_alert > $entity->alert_date)){
                $equipment->next_alert = $entity->alert_date;
                $this->Equipment->save($equipment);
            }else{
                $equipment->dirty('next_service',true);//Fake a change
                $this->Equipment->save($equipment);
            }
        }
        
        return true;
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
        $rules->add($rules->existsIn(['equipment_id'], 'Equipment'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
