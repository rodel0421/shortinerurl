<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Utility\Security;

/**
 * EquipmentTypes Model
 *
 * @property \Cake\ORM\Association\HasMany $Equipment
 *
 * @method \App\Model\Entity\EquipmentType get($primaryKey, $options = [])
 * @method \App\Model\Entity\EquipmentType newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\EquipmentType[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\EquipmentType|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EquipmentType patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\EquipmentType[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\EquipmentType findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
function iconEqHash($data,$field){
    $currentName = $data['name'];
    // return random int so browser does not cache profile image if changed in same date.
    return rand(1000,9999) . Security::hash($currentName.date('YmdHHMMII'), 'sha1', true).substr($currentName,strrpos($currentName,"."));
}
class EquipmentTypesTable extends Table
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

        $this->table('equipment_types');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Equipment', [
            'foreignKey' => 'equipment_type_id'
        ]);
        
        $this->addBehavior('Josegonzalez/Upload.Upload', [
            'icon'=>[
                'path'=>'webroot{DS}upload{DS}icons{DS}',
                'nameCallback' => '\App\Model\Table\iconEqHash'
            ],
            'image'=>[
                'path'=>'secupload{DS}images{DS}',
                'nameCallback' => '\App\Model\Table\iconEqHash'
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
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->requirePresence('category', 'create')
            ->notEmpty('category');

        
        $validator->provider('upload', \Josegonzalez\Upload\Validation\UploadValidation::class);

        $validator
            ->allowEmpty('icon')
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
        
        $validator
            ->allowEmpty('image')
            ->add('image', [
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
                    'rule' => ['isBelowMaxSize', 512000],
                    'message' => 'The image is too large, needs to be below 500 Kb',
                    'provider' => 'upload'
                ]
            ]);


        $validator
            ->boolean('serviceable');
        
        $validator
            ->boolean('track_usage');
        
        $validator
            ->boolean('user_equipment');
        
        $validator
            ->boolean('hourly_booking');
        
        $validator
            ->boolean('auto_approval');

        return $validator;
    }
    
    public function beforeSave($event, $entity, $options)
    {
        if(!empty($entity->icon) &&
                strpos($entity->icon, '/upload/') === false){
            $entity->icon = '/upload/icons/' . $entity->icon;
        }
        
        if(!empty($entity->image) &&
                strpos($entity->image, '/upload/') === false){
            $entity->image = '/upload/images/' . $entity->image;
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
