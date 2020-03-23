<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Utility\Security;

/**
 * CertificationClasses Model
 *
 * @property \Cake\ORM\Association\HasMany $CertificationTypes
 *
 * @method \App\Model\Entity\CertificationClass get($primaryKey, $options = [])
 * @method \App\Model\Entity\CertificationClass newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CertificationClass[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CertificationClass|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CertificationClass patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CertificationClass[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CertificationClass findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
function iconHash($data,$field){
    $currentName = $data['name'];
    // return random int so browser does not cache profile image if changed in same date.
    return rand(1000,9999) . Security::hash($currentName.date('YmdHHMMII'), 'sha1', true).substr($currentName,strrpos($currentName,"."));
}
    
class CertificationClassesTable extends Table
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

        $this->table('certification_classes');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('CertificationTypes', [
            'foreignKey' => 'certification_class_id'
        ]);
        
        $this->addBehavior('Josegonzalez/Upload.Upload', [
            'icon'=>[
                'path'=>'webroot{DS}upload{DS}icons{DS}',
                'nameCallback' => '\App\Model\Table\iconHash'
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

        $validator
            ->requirePresence('short_hand', 'create')
            ->notEmpty('short_hand');

        $validator
            ->allowEmpty('description');
        
        $validator->provider('upload', \Josegonzalez\Upload\Validation\UploadValidation::class);

        $validator
            ->notEmpty('icon')
            ->add('icon', [
                'validExtension' => [
                    'last' => true,
                    'rule' => ['extension',['gif', 'jpeg', 'png', 'jpg']],
                    'provider' => 'table',
                    'message' => __('These files extension are allowed: .gif, .jpg, .png, .jpeg')
                ],
                'file'=>[
                    'rule' => 'isFileUpload',
                    'message' => 'There was no file found to upload',
                    'provider' => 'upload',
                    'last' => true,
                ],
                'filesize'=>[
                    'last' => true,
                    'rule' => ['isBelowMaxSize', 5120],
                    'message' => 'The image is too large, icon must be below 5 Kb',
                    'provider' => 'upload'
                ]
            ]);

        return $validator;
    }
    
    public function beforeSave($event, $entity, $options)
    {
        if(!empty($entity->icon) &&
                strpos($entity->icon, '/upload/') === false){
            $entity->icon = '/upload/icons/' . $entity->icon;
        }
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
}
