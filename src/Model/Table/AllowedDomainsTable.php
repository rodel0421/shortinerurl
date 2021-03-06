<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AllowedDomains Model
 *
 * @method \App\Model\Entity\AllowedDomain get($primaryKey, $options = [])
 * @method \App\Model\Entity\AllowedDomain newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\AllowedDomain[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AllowedDomain|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AllowedDomain patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AllowedDomain[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\AllowedDomain findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AllowedDomainsTable extends Table
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

        $this->setTable('allowed_domains');
        $this->setDisplayField('domain');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
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
            ->requirePresence('domain', 'create')
            ->notEmpty('domain');

        return $validator;
    }
}
