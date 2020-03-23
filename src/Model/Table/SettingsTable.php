<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Settings Model
 *
 * @method \App\Model\Entity\Setting get($primaryKey, $options = [])
 * @method \App\Model\Entity\Setting newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Setting[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Setting|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Setting patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Setting[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Setting findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SettingsTable extends Table
{

    protected function _initializeSchema(\Cake\Database\Schema\Table $schema) {
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

        $this->table('settings');
        $this->displayField('name');
        $this->primaryKey('id');

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
            ->add('short', 'length', ['rule' => ['lengthBetween', 3, 5]])
            ->notEmpty('short');

        $validator
            ->requirePresence('url', 'create')
            ->notEmpty('url');

        $validator
            ->allowEmpty('abn');

        $validator
            ->requirePresence('contact_email', 'create')
            ->notEmpty('contact_email');

        $validator
            ->allowEmpty('postal_address');

        $validator
            ->allowEmpty('billing_email');

        $validator
            ->integer('client_number')
            ->allowEmpty('client_number');

        $validator
            ->allowEmpty('logo');

        $validator
            ->allowEmpty('favicon');

        $validator
            ->allowEmpty('auth_domain_csv');

        $validator
            ->integer('email_disabled')
            ->allowEmpty('email_disabled');

        $validator
            ->allowEmpty('status');
        
        
        $validator
            ->allowEmpty('enabled_areas');

        $validator
            ->date('expires')
            ->allowEmpty('expires');

        return $validator;
    }
}
