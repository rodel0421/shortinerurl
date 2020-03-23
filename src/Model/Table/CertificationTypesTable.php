<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CertificationTypes Model
 *
 * @property \Cake\ORM\Association\BelongsTo $CertificationClasses
 * @property \Cake\ORM\Association\HasMany $Certifications
 *
 * @method \App\Model\Entity\CertificationType get($primaryKey, $options = [])
 * @method \App\Model\Entity\CertificationType newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CertificationType[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CertificationType|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CertificationType patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CertificationType[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CertificationType findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CertificationTypesTable extends Table
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

        $this->table('certification_types');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('CertificationClasses', [
            'foreignKey' => 'certification_class_id'
        ]);
        $this->hasMany('Certifications', [
            'foreignKey' => 'certification_type_id'
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
            ->requirePresence('category', 'create')
            ->add('category','maxLength' ,[
                    'rule' => ['maxLength', 50],
                    'message' => 'Must be less than 50 charecters long'
                ])
            ->notEmpty('category');

        $validator
            ->requirePresence('type', 'create')
            ->add('type','maxLength' ,[
                    'rule' => ['maxLength', 50],
                    'message' => 'Must be less than 50 charecters long'
                ])
            ->notEmpty('type');

        $validator
            ->requirePresence('name', 'create')
                ->add('name','maxLength' ,[
                    'rule' => ['maxLength', 45],
                    'message' => 'Must be less than 45 charecters long'
                ])
            ->notEmpty('name');

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
        $rules->add($rules->existsIn(['certification_class_id'], 'CertificationClasses'));

        return $rules;
    }
}
