<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ResourceCategories Model
 *
 * @property \App\Model\Table\ResourcesTagsTable|\Cake\ORM\Association\HasMany $ResourcesTags
 *
 * @method \App\Model\Entity\ResourceCategory get($primaryKey, $options = [])
 * @method \App\Model\Entity\ResourceCategory newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ResourceCategory[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ResourceCategory|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ResourceCategory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ResourceCategory[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ResourceCategory findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ResourceCategoriesTable extends Table
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

        $this->setTable('resource_categories');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('ResourcesTags', [
            'foreignKey' => 'resource_category_id'
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
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->allowEmpty('description');

        return $validator;
    }
}
