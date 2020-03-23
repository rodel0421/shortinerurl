<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Facilities Model
 *
 * @property \Cake\ORM\Association\HasMany $Bookings
 * @property \Cake\ORM\Association\HasMany $BookingsTemplates
 * @property \Cake\ORM\Association\HasMany $ClientTypes
 * @property \Cake\ORM\Association\HasMany $Equipment
 * @property \Cake\ORM\Association\HasMany $Items
 * @property \Cake\ORM\Association\HasMany $Messages
 * @property \Cake\ORM\Association\HasMany $Resources
 * @property \Cake\ORM\Association\HasMany $RosterShifts
 * @property \Cake\ORM\Association\HasMany $RosterUsers
 * @property \Cake\ORM\Association\HasMany $Users
 * @property \Cake\ORM\Association\BelongsToMany $Users
 *
 * @method \App\Model\Entity\Facility get($primaryKey, $options = [])
 * @method \App\Model\Entity\Facility newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Facility[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Facility|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Facility patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Facility[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Facility findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class FacilitiesTable extends Table
{
    
    protected function _initializeSchema(\Cake\Database\Schema\TableSchema $schema) {
        $schema->columnType('enabled_areas', 'csv');
        
        return $schema;
    }

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('facilities');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Bookings', [
            'foreignKey' => 'facility_id'
        ]);
        $this->hasMany('BookingsTemplates', [
            'foreignKey' => 'facility_id'
        ]);
        $this->hasMany('ClientTypes', [
            'foreignKey' => 'facility_id'
        ]);
        $this->hasMany('Equipment', [
            'foreignKey' => 'facility_id'
        ]);
        $this->hasMany('Items', [
            'foreignKey' => 'facility_id'
        ]);
        $this->hasMany('Messages', [
            'foreignKey' => 'facility_id'
        ]);
        $this->hasMany('Resources', [
            'foreignKey' => 'facility_id',
            'conditions' => ['Resources.active'=>1]
        ]);
        $this->hasMany('RosterShifts', [
            'foreignKey' => 'facility_id'
        ]);
        $this->hasMany('RosterUsers', [
            'foreignKey' => 'facility_id'
        ]);
        $this->hasMany('Users', [
            'foreignKey' => 'facility_id'
        ]);
        $this->belongsToMany('Users', [
            'foreignKey' => 'facility_id',
            'targetForeignKey' => 'user_id',
            'joinTable' => 'facilities_users'
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
            ->notEmpty('title')
            ->add('title', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        
        $validator
            ->requirePresence('abv', 'create')
            ->notEmpty('abv')
            ->add('abv', [
                'alphaNumeric'=>[
                    'rule'=>'alphaNumeric',
                    'last' => true,
                    'message' => 'Letters and numbers only.'
                ],
                'minLength' => [
                    'rule' => ['minLength', 3],
                    'last' => true,
                    'message' => '3 to 10 charecters'
                ],
                'maxLength' => [
                    'rule' => ['maxLength', 10],
                    'last' => true,
                    'message' => '3 to 10 charecters'
                ],
                'unique'=>[
                    'rule' => 'validateUnique', 
                    'provider' => 'table',
                    'message' => 'Must be unique']
            ]);
        
        $validator
            ->allowEmpty('description');

        $validator
            ->allowEmpty('notes');

        $validator
            ->allowEmpty('bookings_email');

        $validator
            ->allowEmpty('users_email');

        $validator
            ->allowEmpty('enabled_areas');
        
        //json_decode ( string $json 

        return $validator;
    }
    
    public function beforeSave($event, $entity, $options)
    {
        if(!empty($entity->bookings_calendar)){
            //Validate custom data
            //just remove invalid entries
            $list = json_decode ( $entity->bookings_calendar);
            
            $save = [];
            if($list){
                foreach($list as $row){
                    
                    if(!(isset($row->custom_from) && isset($row->custom_to) &&
                        isset($row->custom_background) 
                        && isset($row->custom_colour)
                        && $this->check_valid_colorhex($row->custom_background)
                            && $this->check_valid_colorhex($row->custom_colour)
                        )){
                        continue;//skip this one.
                    }
                    $tmp = new \stdClass();
                    $tmp->custom_from = abs( (int) $row->custom_from) ;
                    $tmp->custom_to =  abs( (int) $row->custom_to);
                    $tmp->custom_background = $row->custom_background;
                    $tmp->custom_colour = $row->custom_colour;
                    
                    $save[] = $tmp;
                }
            }
            $entity->bookings_calendar = json_encode($save);
        }
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
        $rules->add($rules->isUnique(['title']));

        return $rules;
    }
    
    private function check_valid_colorhex($colorCode) {
    // If user accidentally passed along the # sign, strip it off
    $colorCode = ltrim($colorCode, '#');

    if (
          ctype_xdigit($colorCode) &&
          (strlen($colorCode) == 6 || strlen($colorCode) == 3))
               return true;

        else return false;
    }
}
