<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Datasource\ConnectionManager;

/**
 * Registers Model
 *
 * @property \Cake\ORM\Association\BelongsTo $RegisterTemplates
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $RegisterClasses
 * @property \Cake\ORM\Association\BelongsTo $Departments
 * @property \Cake\ORM\Association\HasMany $RegisterChecklists
 * @property \Cake\ORM\Association\HasMany $RegisterForms
 *
 * @method \App\Model\Entity\Register get($primaryKey, $options = [])
 * @method \App\Model\Entity\Register newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Register[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Register|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Register patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Register[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Register findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class RegistersTable extends Table
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

        $this->table('registers');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('RegisterTemplates', [
            'foreignKey' => 'register_template_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
            'finder'=>'short'
        ]);
        $this->belongsTo('RegisterClasses', [
            'foreignKey' => 'register_class_id',
        ]);
        $this->belongsTo('Departments', [
            'foreignKey' => 'department_id',
            'finder'=>'short'
        ]);
        $this->hasMany('RegisterChecklists', [
            'foreignKey' => 'register_id'
        ]);
        $this->hasMany('RegisterForms', [
            'foreignKey' => 'register_id'
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
            ->integer('register_template_id')    
            ->requirePresence('register_template_id', 'create')
            ->notEmpty('register_template_id');
        
        $validator
            ->integer('department_id')    
            ->notEmpty('department_id');
        
        $validator
            ->integer('user_id')    
            ->requirePresence('user_id', 'create')
            ->notEmpty('user_id');
        
        $validator
            ->requirePresence('status', 'create')
            ->notEmpty('status');
        
        $validator->notEmpty('register_class_id', 'This field is required when status is requstered', function ($context) {
            return !empty($context['data']['status']) && $context['data']['status'] == 'Registered';
        });
        
        $validator
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        $validator
            ->allowEmpty('notes');

        return $validator;
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
        $rules->add($rules->existsIn(['register_template_id'], 'RegisterTemplates'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['register_class_id'], 'RegisterClasses'));
        $rules->add($rules->existsIn(['department_id'], 'Departments'));

        return $rules;
    }
    
    public function afterSave($event, $entity, $options) {
        //only run on status update   
        if(!$entity->dirty('cert_status_date')){
            return true;
        }
        
        $connection = ConnectionManager::get('default');
        
        //Update user statuses
        $query = "INSERT INTO user_statuses (user_id, `status`, status_date, `type`, modified) 
select * from (
select c.user_id, max(c.cert_status) as max_status, min(c.cert_status_date) as min_date, 'Registers' ,NOW()
from registers c
where c.active = 1 AND c.`status` = 'Registered' AND c.user_id = :user_id AND c.cert_status_date IS NOT NULL
) as s where s.user_id IS NOT NULL
ON DUPLICATE KEY UPDATE `status`= s.max_status, status_date= s.min_date, modified=NOW();";
        
        $connection->execute($query,['user_id'=>$entity->user_id]);
        
        return true;
    }
    
    public function processAll($user_id = null){
        
        $conditions = [
            'Registers.active'=>true,
            'Users.active'=>true];
        
        if(isset($user_id)){
            $conditions['Users.id'] =$user_id;
        }
        
        $registers = $this->find('all', [
            'contain' => [
                'RegisterTemplates'=>['fields'=>['id','required_certifications']], 
                'Users'=>[
                    'Certifications'=>
                        [
                            'fields'=>['id','status','status_date','user_id'],
                            'CertificationTypes'=>['fields'=>['id','type']]]], 
            ],
            'conditions'=>$conditions
        ]);
        
        foreach($registers as $register){
            $this->process($register);
        }
    }
    
    public function process($register){
        
        if(!($register->has('register_template') && $register->has('user'))){
            return false;
        }
        
        $has = [];
        $requered = $register->register_template->required_certifications;
        $status = 1;//No certs needed - Happy
        
        //TODO: if no required skip the next steps
        
        if(!empty($requered)){
            
            //check all certs against required type
            if($register->user->has('certifications')){
                foreach ($register->user->certifications as $certifications){
                    $type = $certifications->has('certification_type') ? $certifications->certification_type->type : '';
                    if($type){
                        //If already has type - take the most current one
                        if(isset($has[$type])){
                            $has[$type] = ($has[$type] > $certifications->status)? $certifications->status : $has[$type];
                        }else{
                            $has[$type] = $certifications->status;
                        }
                    }
                }
            }

            foreach($requered as $cert){
                if(isset($has[$cert])){ //Has a cert
                    //set to largest status
                    $status = ($status < $has[$cert])? $has[$cert] :$status;
                }else{
                    //dosn't have the cert - fail
                    $status = 3;
                }

                if($status == 3) break; //dont check anymore as missing atleat one.
            }
        }
        
        $register->cert_status = $status;
        $register->cert_status_date = date('Y-m-d H:i:s');
        
        $this->save($register);
        
    }
}
