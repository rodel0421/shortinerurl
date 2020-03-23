<?php
namespace App\Model\Table;

use App\Model\Entity\Task;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Utility\Security;
use Cake\Auth\DefaultPasswordHasher;

/**
 * Tasks Model
 */
class TokensTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('tokens');
        $this->displayField('token');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');
        
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator){
        $validator
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');
            
        $validator
            ->requirePresence('token', 'create')
            ->notEmpty('token');
        
        $validator
            ->requirePresence('type', 'create')
            ->notEmpty('type');
        
        $validator
            ->requirePresence('password', 'create')
            ->notEmpty('password');
        
        $validator
            ->add('expires', 'valid', ['rule' => 'datetime'])
            ->allowEmpty('expires');
        
        return $validator;
    }
    
    public function generate($type, $user_id = null, $expires = null ){
        
        $key = Security::hash(Security::randomBytes(30), 'sha1', true);
        $passsword = Security::hash(Security::randomBytes(30), 'sha1', true);
        
        $token = $this->newEntity([
            'user_id'=>$user_id,
            'type'=>$type,
            'token'=>$key,
            'password'=>$passsword,
            'expires'=>$expires
        ]);
        
        if ($this->save($token)) {
            return ['t'=>$key,'p'=>$passsword];
        }
        
        return false;
    }
    
    public function check($type,$token,$password,$user_id = null)
    {
        //Removed all expired tokens
        $this->garbage();
        
        //Search for valid token
        $token = $this->find()
                ->where(['type'=>$type,'token'=>$token,'user_id'=>$user_id])
                ->first();
        
        //If found return true
        if ($token) {
            //check password
            if((new DefaultPasswordHasher)->check($password,$token->password)){
                return true;
            }else{
                return false;
            }
            
        }
        
        return false;
    }
    
    public function expire($token){
        return $this->deleteAll(['token'=>$token]);
    }
    
    
    private function garbage()
    {   
        return $this->deleteAll(array('expires < NOW()'));
    }
    
  
}
