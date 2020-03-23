<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * FormTemplates Model
 *
 * @method \App\Model\Entity\FormTemplate get($primaryKey, $options = [])
 * @method \App\Model\Entity\FormTemplate newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\FormTemplate[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\FormTemplate|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FormTemplate patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\FormTemplate[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\FormTemplate findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class FormTemplatesTable extends Table
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

        $this->table('form_templates');
        $this->displayField('title');
        $this->primaryKey('id');
        
        $this->addBehavior('ChrisShick/CakePHP3HtmlPurifier.HtmlPurifier', [
            'fields'=>['form'],
            'config'=>[
                'Attr'=>[
                    'EnableID'=>true,
                    'IDPrefix'=>'form_',
                    'AllowedFrameTargets'=>['_blank', '_self', '_parent', '_top']
                    ],
                'HTML'=>[
                    'TidyLevel' => 'heavy',
                    'Doctype' => 'HTML 5',
                    'Trusted'=>true,
                    //'AllowedAttributes'=>['a.target', 'a.href']
                   // 'AllowedAttributes'=>'*[for]'
                ],
                //'CSS'=>['ForbiddenProperties'=>['label.for']],
                'AutoFormat'=>[
                    'RemoveSpansWithoutAttributes' => true,
                    'RemoveEmpty' => true],
                'Cache'=>[
                    'SerializerPath'=>TMP
                    ]
                ]
        ]);

        $this->addBehavior('Timestamp');
    }
    /*
    public function beforeMarshal($event, $data, $options){
        debug($data);
    }
    
    public function beforeSave($event, $entity, $options){
        debug($entity);
        die();
    }*/

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
            ->integer('revision')
            ->requirePresence('revision', 'create')
            ->notEmpty('revision');

        $validator
            ->allowEmpty('form');

        $validator
            ->allowEmpty('validation');

        return $validator;
    }
}
