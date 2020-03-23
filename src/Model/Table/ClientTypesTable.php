<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ClientTypes Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Facilities
 * @property \Cake\ORM\Association\HasMany $BookingFees
 * @property \Cake\ORM\Association\HasMany $BookingPersonnel
 *
 * @method \App\Model\Entity\ClientType get($primaryKey, $options = [])
 * @method \App\Model\Entity\ClientType newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ClientType[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ClientType|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ClientType patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ClientType[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ClientType findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ClientTypesTable extends Table
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

        $this->table('client_types');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Facilities', [
            'foreignKey' => 'facility_id'
        ]);
        $this->hasMany('BookingFees', [
            'foreignKey' => 'client_type_id'
        ]);
        $this->hasMany('BookingPersonnel', [
            'foreignKey' => 'client_type_id'
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
            ->allowEmpty('description');

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
        $rules->add($rules->existsIn(['facility_id'], 'Facilities'));

        return $rules;
    }
}
