<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Utility\Security;

/**
 * Resources Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $Facilities
 * @property \Cake\ORM\Association\BelongsTo $Groups
 * @property \Cake\ORM\Association\BelongsTo $ParentResources
 * @property \Cake\ORM\Association\HasMany $ChildResources
 *
 * @method \App\Model\Entity\Resource get($primaryKey, $options = [])
 * @method \App\Model\Entity\Resource newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Resource[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Resource|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Resource patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Resource[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Resource findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 * @mixin \Cake\ORM\Behavior\TreeBehavior
 */
function resourceNameHash($data,$field){
    $currentName = $data['name'];
    // return random int so browser does not cache profile image if changed in same date.
    return rand(1000,9999) . Security::hash($currentName.date('YmdHHMMII'), 'sha1', true).substr($currentName,strrpos($currentName,"."));
}
class ResourcesTable extends Table
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

        $this->table('resources');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Tree',[
            'recoverOrder' => ['title' => 'ASC'],
        ]);

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
        ]);
        $this->belongsTo('Facilities', [
            'foreignKey' => 'facility_id'
        ]);
        $this->belongsTo('Groups', [
            'foreignKey' => 'group_id'
        ]);
        $this->belongsTo('ParentResources', [
            'className' => 'Resources',
            'foreignKey' => 'parent_id'
        ]);
        $this->hasMany('ChildResources', [
            'className' => 'Resources',
            'foreignKey' => 'parent_id'
        ]);
        
        $this->belongsToMany('ResourceCategories', [
            'targetForeignKey' => 'resource_category_id',
            'foreignKey' => 'resource_id',
            'joinTable' => 'resources_tags',
        ]);
        
        $this->addBehavior('Josegonzalez/Upload.Upload', [
            'doc'=>[
                'path'=>'secupload{DS}resources{DS}',
                'fields' => [
                    'size' => 'doc_size',
                    'type' => 'doc_type'
                ],
                'nameCallback' => '\App\Model\Table\resourceNameHash'
            ],
        ]);
        
        $this->addBehavior('ChrisShick/CakePHP3HtmlPurifier.HtmlPurifier', [
            'fields'=>['notes'],
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
            ->requirePresence('description', 'create')
            ->notEmpty('description');

        $validator->provider('upload', \Josegonzalez\Upload\Validation\UploadValidation::class);
        
        $validator
            ->notEmpty('doc', 'Document Required', 'create')
            ->add('doc', [
                'validExtension' => [
                    'last' => true,
                    'rule' => ['extension',['pdf','gif', 'jpeg', 'png', 'jpg','csv']],
                    'provider' => 'table',
                    'message' => __('These files extension are allowed: .pdf, .gif, .jpg, .png, .jpeg, .csv')
                ],
                'file'=>[
                    'rule' => 'isFileUpload',
                    'message' => 'There was no file found to upload',
                    'provider' => 'upload',
                    'last' => true,
                ],
                'filesize'=>[
                    'last' => true,
                    'rule' => ['isBelowMaxSize', 5242880],//5MB
                    'message' => 'The file is too large',
                    'provider' => 'upload'
                ]
            ]);

        $validator->notEmpty('notes');

        $validator
            ->notEmpty('link')
            ->add('link', 'valid-url', ['rule' => 'url']);

        return $validator;
    }
    
    public static function extension($check, $extensions = ['gif', 'jpeg', 'png', 'jpg'])
    {
        if (is_array($check)) {
            if(isset($check['name'])){
                return static::extension($check['name'], $extensions);
            }
            
            return false;
        }
        $extension = strtolower(pathinfo($check, PATHINFO_EXTENSION));
        foreach ($extensions as $value) {
            if ($extension === strtolower($value)) {
                return true;
            }
        }

        return false;
    }
    
    protected function _buildCategoriesFromString($categoryString){
        return $this->_buildCategories(array_map('trim', explode(',', $categoryString)));
    }
    
    protected function _buildCategories($categories)
    {
        $new = array_unique($categories); //make unique
        $out = [];
        $query = $this->ResourceCategories->find()
            ->where(['ResourceCategories.name IN' => $new]);

        // Remove existing tags from the list of new tags.
        foreach ($query->extract('name') as $existing) {
            $index = array_search($existing, $new);
            if ($index !== false) {
                unset($new[$index]);
            }
        }
        // Add existing tags.
        foreach ($query as $tag) {
            $out[] = $tag;
        }
        // Add new tags.
        foreach ($new as $tag) {
            $out[] = $this->ResourceCategories->newEntity(['name' => $tag]);
        }
        return $out;
    }
    
    public function beforeSave($event, $entity, $options){
        if(!empty($entity->doc) &&
                strpos($entity->doc, '/upload/') === false){
            
            $entity->doc_ext = strtolower(substr($entity->doc,strrpos($entity->doc,".")+1));
            
            $entity->doc = '/upload/resources/'. $entity->doc;
        }
        
        if ($entity->categories && is_array($entity->categories)) {
            $entity->resource_categories = $this->_buildCategories($entity->categories);
        }
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
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['facility_id'], 'Facilities'));
        $rules->add($rules->existsIn(['group_id'], 'Groups'));
        $rules->add($rules->existsIn(['parent_id'], 'ParentResources'));

        return $rules;
    }
}
