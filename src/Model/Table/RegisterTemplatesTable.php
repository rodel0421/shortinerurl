<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RegisterTemplates Model
 *
 * @property \Cake\ORM\Association\HasMany $RegisterAdmins
 * @property \Cake\ORM\Association\HasMany $RegisterClasses
 * @property \Cake\ORM\Association\HasMany $Registers
 *
 * @method \App\Model\Entity\RegisterTemplate get($primaryKey, $options = [])
 * @method \App\Model\Entity\RegisterTemplate newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\RegisterTemplate[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RegisterTemplate|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RegisterTemplate patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\RegisterTemplate[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\RegisterTemplate findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class RegisterTemplatesTable extends Table
{
    
    protected function _initializeSchema(\Cake\Database\Schema\Table $schema) {
        $schema->columnType('required_forms', 'csv');
        $schema->columnType('required_certifications', 'csv');
        $schema->columnType('optional_certifications', 'csv');
        
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

        $this->table('register_templates');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsToMany('Departments', [
            'foreignKey' => 'register_template_id',
            'targetForeignKey' => 'department_id',
            'joinTable' => 'register_admins'
        ]);
                
        $this->hasMany('RegisterClasses', [
            'foreignKey' => 'register_template_id'
        ]);
        $this->hasMany('Registers', [
            'foreignKey' => 'register_template_id'
        ]);
        
        $this->addBehavior('ADmad/Sequence.Sequence', [
            'order' => 'order', // Field to use to store integer sequence. Default "position".
            'start' => 1, // Initial value for sequence. Default 1.
        ]);
        
        $this->addBehavior('ChrisShick/CakePHP3HtmlPurifier.HtmlPurifier', [
            'fields'=>['about'],
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
    
    public function findShort(Query $query, array $options){
        
       // debug($query);
        
        $query->select(['id','name','form_type']);
        //$query->autoFields(true);
        
        //debug($query);
        //        ->contain();
        return $query;
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
            ->notEmpty('name')
            ->add('name', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->allowEmpty('about');

        $validator
            ->allowEmpty('form_type');

        $validator
            ->allowEmpty('checklists');

        $validator
            ->allowEmpty('required_certifications');
        $validator
            ->allowEmpty('optional_certifications');

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
        $rules->add($rules->isUnique(['name']));

        return $rules;
    }
}
