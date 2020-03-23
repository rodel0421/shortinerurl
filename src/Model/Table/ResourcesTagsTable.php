<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ResourcesTags Model
 *
 * @property \App\Model\Table\ResourcesTable|\Cake\ORM\Association\BelongsTo $Resources
 * @property \App\Model\Table\ResourceCategoriesTable|\Cake\ORM\Association\BelongsTo $ResourceCategories
 *
 * @method \App\Model\Entity\ResourcesTag get($primaryKey, $options = [])
 * @method \App\Model\Entity\ResourcesTag newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ResourcesTag[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ResourcesTag|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ResourcesTag patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ResourcesTag[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ResourcesTag findOrCreate($search, callable $callback = null, $options = [])
 */
class ResourcesTagsTable extends Table
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

        $this->setTable('resources_tags');
        $this->setDisplayField('resource_id');
        $this->setPrimaryKey(['resource_id', 'resource_category_id']);

        $this->belongsTo('Resources', [
            'foreignKey' => 'resource_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('ResourceCategories', [
            'foreignKey' => 'resource_category_id',
            'joinType' => 'INNER'
        ]);
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
        $rules->add($rules->existsIn(['resource_id'], 'Resources'));
        $rules->add($rules->existsIn(['resource_category_id'], 'ResourceCategories'));

        return $rules;
    }
}
