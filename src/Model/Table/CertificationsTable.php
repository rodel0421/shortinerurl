<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Utility\Security;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;

/**
 * Certifications Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $CertificationTypes
 *
 * @method \App\Model\Entity\Certification get($primaryKey, $options = [])
 * @method \App\Model\Entity\Certification newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Certification[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Certification|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Certification patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Certification[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Certification findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
function certHash($data,$field){
    $currentName = $data['name'];
    // return random int so browser does not cache profile image if changed in same date.
    return rand(1000,9999) . Security::hash($currentName.date('YmdHHMMII'), 'sha1', true).substr($currentName,strrpos($currentName,"."));
}

class CertificationsTable extends Table
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

        $this->table('certifications');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        
        $this->belongsTo('Validated', [
            'className'=>'Users',
            'propertyName' => 'validated',
            'foreignKey' => 'validated_by',
            'finder'=>'short'
        ]);
        
        $this->belongsTo('CertificationTypes', [
            'foreignKey' => 'certification_type_id',
            'joinType' => 'INNER'
        ]);
        
        $this->addBehavior('Josegonzalez/Upload.Upload', [
            'file_url'=>[
                'path'=>'secupload{DS}users{DS}{field-value:user_id}{DS}',
                'fields' => [
                    'size' => 'filesize',
                    'type' => 'mime_type'
                ],
                'nameCallback' => '\App\Model\Table\certHash'
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
            ->integer('certification_type_id')    
            ->requirePresence('certification_type_id', 'create')
            ->notEmpty('certification_type_id');
        
        $validator
            ->requirePresence('issuer', 'create')
            ->notEmpty('issuer');

        $validator
            ->date('issued')
            ->allowEmpty('issued');

        $validator
            ->date('expires')
            ->notEmpty('expires');

        $validator
            ->integer('validated_by')
            ->allowEmpty('validated_by');

        $validator
            ->dateTime('validated_date')
            ->allowEmpty('validated_date');

        $validator
            ->boolean('valid')
            ->allowEmpty('valid');

        $validator->provider('upload', \Josegonzalez\Upload\Validation\UploadValidation::class);
        
        $validator
            ->allowEmpty('file_url')
            ->add('file_url', [
                'validExtension' => [
                    'last' => true,
                    'rule' => ['extension',['pdf','gif', 'jpeg', 'png', 'jpg']],
                    'provider' => 'table',
                    'message' => __('These files extension are allowed: .pdf, .gif, .jpg, .png, .jpeg')
                ],
                'file'=>[
                    'rule' => 'isFileUpload',
                    'message' => 'There was no file found to upload',
                    'provider' => 'upload',
                    'last' => true,
                ],
                'filesize'=>[
                    'last' => true,
                    'rule' => ['isBelowMaxSize', 5242880],//5MB
                    'message' => 'The file is too large',
                    'provider' => 'upload'
                ]
            ]);

        $validator
            ->allowEmpty('file_name');

        $validator
            ->allowEmpty('mime_type');

        $validator
            ->allowEmpty('filesize');

        $validator
            ->allowEmpty('extension');

        $validator
            ->allowEmpty('notes');

        $validator
            ->boolean('active')
            ->requirePresence('active', 'create')
            ->notEmpty('active');

        $validator
            ->integer('status')
            ->allowEmpty('status');

        $validator
            ->dateTime('status_date')
            ->allowEmpty('status_date');

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
        if(!empty($entity->file_url) && !is_array($entity->file_url) && !empty($entity->user_id) &&
                strpos($entity->file_url, '/upload/') === false){
            
            $entity->extension = strtolower(substr($entity->file_url,strrpos($entity->file_url,".")+1));
            
            $entity->file_url = '/upload/users/'.$entity->user_id.'/' . $entity->file_url;
        }
        
        $uploaded_file = $entity->getOriginal('file_url');
        if(isset($uploaded_file['name'])){
            $entity->file_name = $uploaded_file['name'];
        }
        
    }
    
    /*
     *
     * status 
     * 4 => System Error or Inactive
     * 3 => Not Valid
     * 2 => Soon to expire or not yet verified
     * 1 => Status OK - No expiry value or current
     * 
     * Inactive certifications are ignored. 
     */
    public function afterSave($event, $entity, $options) {
        //debug($entity);
        //die();
        //Dont enter loop :)    
        if($entity->dirty('status_date')){
            return true;
        }
        
        $connection = ConnectionManager::get('default');
        
        
        //replace old cert with new
        /*
        if(isset($this->data['Certification']['replace']) && !empty($this->data['Certification']['replace']) && isset($this->data['Certification']['user_id'])){
            $replace_id = $this->data['Certification']['replace'];
            $owner_id = $this->data['Certification']['user_id']; //no fishy business :)
            
            //Update user statuses
            //$query = "UPDATE certifications SET active=0 WHERE user_id=$owner_id and id=$replace_id;";
            $connection->update('certifications',['active'=>0],['user_id'=>$owner_id,'id'=>$replace_id]);
            unset($this->data['Certification']['replace']);
        }*/
      
        $status = 4; //Start with error status
        //If active
        if($entity->active == 1){

            //if expired
            if(!empty($entity->expires)){
                //Expires greater than one month away
                
                if($entity->expires->i18nFormat('yyyy-MM-dd') > date("Y-m-d", strtotime("+1 month"))){
                    $status = 1; //Good
                }elseif($entity->expires->i18nFormat('yyyy-MM-dd') > date("Y-m-d")){
                    //Will expire in the next month
                    $status = 2;
                }else{
                    //Has expired already
                    $status = 3;
                }
            }else{
                $status = 1; //Not expiring ever
            }

            if($entity->valid == 0){
                $status = 2;// Not yet validated
            }
        }

        //Set status
        $entity->status = $status;
        $entity->status_date = date('Y-m-d H:i:s');

        $result = $this->save($entity);

        //Update user statuses
        $query = "INSERT INTO user_statuses (user_id, `status`, status_date, `type`, modified) 
select * from (
select c.user_id, max(c.`status`) as max_status, min(c.status_date) as min_date, 'Certifications' ,NOW()
from certifications c
where c.active = 1 AND c.user_id = :user_id AND c.status_date IS NOT NULL
) as s where s.user_id IS NOT NULL
ON DUPLICATE KEY UPDATE `status`= s.max_status, status_date= s.min_date, modified=NOW();";
        
        $connection->execute($query,['user_id'=>$entity->user_id]);
        
        
        //Now update status for registers
        TableRegistry::get('Registers')->processAll($entity->user_id);
        
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
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['validated_by'], 'Users'));
        $rules->add($rules->existsIn(['certification_type_id'], 'CertificationTypes'));

        return $rules;
    }
}
