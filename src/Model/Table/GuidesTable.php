<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Guides Model
 *
 * @method \App\Model\Entity\Guide get($primaryKey, $options = [])
 * @method \App\Model\Entity\Guide newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Guide[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Guide|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Guide patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Guide[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Guide findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class GuidesTable extends Table
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

        $this->setTable('guides');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        
        $this->addBehavior('ChrisShick/CakePHP3HtmlPurifier.HtmlPurifier', [
            'fields'=>['notes'],
            'config'=>[//iframe
                'HTML'=>[
                    'TidyLevel' => 'heavy',
                    'Doctype' => 'HTML 5',
                    'SafeIframe'=>true
                ],
                'URI'=>[
                    'SafeIframeRegexp'=>'%^(https?:)?//(www\.youtube(?:-nocookie)?\.com/embed/|player\.vimeo\.com/video/)%'
                ],
                'AutoFormat'=>[
                    'RemoveSpansWithoutAttributes' => true,
                    'RemoveEmpty' => true],
                'Cache'=>[
                'SerializerPath'=>TMP]
                ]
        ]);
        
        $this->addBehavior('Tree');
        $this->belongsTo('ParentGuides', [
            'className' => 'Guides',
            'foreignKey' => 'parent_id'
        ]);
        $this->hasMany('ChildGuides', [
            'className' => 'Guides',
            'foreignKey' => 'parent_id'
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
            ->requirePresence('controller', 'create')
            ->notEmpty('controller');

        $validator
            ->allowEmpty('action');

        $validator
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->requirePresence('notes', 'create')
            ->notEmpty('notes');

        return $validator;
    }
}
