<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Utility\Security;

/**
 * UserDocs Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\UserDoc get($primaryKey, $options = [])
 * @method \App\Model\Entity\UserDoc newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\UserDoc[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\UserDoc|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UserDoc patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\UserDoc[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\UserDoc findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */

function userDocHash($data,$field){
    $currentName = $data['name'];
    // return random int so browser does not cache profile image if changed in same date.
    return rand(1000,9999) . Security::hash($currentName.date('YmdHHMMII'), 'sha1', true).substr($currentName,strrpos($currentName,"."));
}
class UserDocsTable extends Table
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

        $this->table('user_docs');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        
        $this->addBehavior('Josegonzalez/Upload.Upload', [
            'file_url'=>[
                'path'=>'secupload{DS}users{DS}{field-value:user_id}{DS}',
                'fields' => [
                    'size' => 'filesize',
                    'type' => 'mime_type'
                ],
                'nameCallback' => '\App\Model\Table\userDocHash'
            ],
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

        $validator->provider('upload', \Josegonzalez\Upload\Validation\UploadValidation::class);
        
        $validator
            ->notEmpty('file_url','Required')
            ->add('file_url', [
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


        $validator
            ->allowEmpty('mime_type');

        $validator
            ->allowEmpty('filesize');

        $validator
            ->allowEmpty('extension');

        $validator
            ->boolean('private')
            ->allowEmpty('private');

        $validator
            ->boolean('active')
            ->allowEmpty('active');

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
    
    public function beforeSave($event, $entity, $options){
        if(!empty($entity->file_url) && !empty($entity->user_id) &&
                strpos($entity->file_url, '/upload/') === false){
            
            $entity->extension = strtolower(substr($entity->file_url,strrpos($entity->file_url,".")+1));
            
            $entity->file_url = '/upload/users/'.$entity->user_id.'/' . $entity->file_url;
        }
        
        $uploaded_file = $entity->getOriginal('file_url');
        if(isset($uploaded_file['name'])){
            $entity->file_name = $uploaded_file['name'];
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

        return $rules;
    }
}
