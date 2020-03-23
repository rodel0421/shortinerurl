<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EquipmentLinks Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Equipment
 *
 * @method \App\Model\Entity\EquipmentLink get($primaryKey, $options = [])
 * @method \App\Model\Entity\EquipmentLink newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\EquipmentLink[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\EquipmentLink|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EquipmentLink patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\EquipmentLink[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\EquipmentLink findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EquipmentLinksTable extends Table
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

        $this->table('equipment_links');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Equipment', [
            'foreignKey' => 'equipment_id',
            'joinType' => 'INNER'
        ]);
        
        $this->belongsTo('RelatedEquipment', [
            'class'=>'Equipment',
            'propertyName'=>'related_to_equipment',
            'foreignKey' => 'equipment_id',
            'joinType' => 'INNER'
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
            ->integer('equipment_id')
            ->requirePresence('equipment_id', 'create')
            ->notEmpty('equipment_id');
        
        $validator
            ->integer('related_equipment')
            ->requirePresence('related_equipment', 'create')
            ->notEmpty('related_equipment');

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
        $rules->add($rules->existsIn(['equipment_id'], 'Equipment'));
        $rules->add($rules->existsIn(['related_equipment'], 'Equipment'));

        return $rules;
    }
}
