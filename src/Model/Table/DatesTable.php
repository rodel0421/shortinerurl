<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;

/**
 * Dates Model
 *
 * @method \App\Model\Entity\Date get($primaryKey, $options = [])
 * @method \App\Model\Entity\Date newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Date[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Date|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Date patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Date[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Date findOrCreate($search, callable $callback = null, $options = [])
 */
class DatesTable extends Table
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

        $this->table('dates');
        $this->displayField('dt');
        $this->primaryKey('dt');
    }
    
    public function setupDates(){
        $count = 500;
        $date = $this->getLast();
        
        
        $days = floor((time() - strtotime($date)) / 86400);//days ago
        if($days > 0){ //in past
            $count += $days;
        }
        
        //Only run if needed
        if($days < -500){
            return false;
        }
        
        if($count > 1000){
            $times = floor($count / 1000);
            for($i = 0;$i <= $times;$i++){
                $this->setupFrom($this->getLast(),1000);
            }
        }else{
            $this->setupFrom($this->getLast(),$count);
        }
        $this->setupAtts();
        
        return true;
        
    }
    
    public function getLast(){
        $last = $this->find('all',['order'=>['dt'=>'desc']])->first();
        
        if($last){
            return $last->dt->addDays(1)->i18nFormat('yyyy-MM-dd');
        }
        
        $settings = TableRegistry::get('Settings')->find()->first();
        
        if($settings){
            return $settings->created->i18nFormat('yyyy-MM-dd');
        }
        
        return date('Y').'-01-01';//Start of year
        
    }
    
    public function setupFrom($date,$days = 500){
        
        //Check date
        if (!preg_match("/^[0-9]{4}-[0-1][0-9]-[0-3][0-9]$/",$date)){
            return false;
        }
        
        $connection = ConnectionManager::get('default');
        
        $query = "INSERT INTO dates (dt)
            SELECT (:date + INTERVAL c.number DAY) AS date
FROM (SELECT singles + tens + hundreds number FROM 
( SELECT 0 singles
UNION ALL SELECT   1 UNION ALL SELECT   2 UNION ALL SELECT   3
UNION ALL SELECT   4 UNION ALL SELECT   5 UNION ALL SELECT   6
UNION ALL SELECT   7 UNION ALL SELECT   8 UNION ALL SELECT   9
) singles JOIN 
(SELECT 0 tens
UNION ALL SELECT  10 UNION ALL SELECT  20 UNION ALL SELECT  30
UNION ALL SELECT  40 UNION ALL SELECT  50 UNION ALL SELECT  60
UNION ALL SELECT  70 UNION ALL SELECT  80 UNION ALL SELECT  90
) tens  JOIN 
(SELECT 0 hundreds
UNION ALL SELECT  100 UNION ALL SELECT  200 UNION ALL SELECT  300
UNION ALL SELECT  400 UNION ALL SELECT  500 UNION ALL SELECT  600
UNION ALL SELECT  700 UNION ALL SELECT  800 UNION ALL SELECT  900
) hundreds
ORDER BY number DESC) c  
WHERE c.number BETWEEN 0 and :days;";
        
        $result = $connection->execute($query,['days'=>(int)$days,'date'=>$date]);
        
        
        return $result;
    }
    
    public function setupAtts(){
        $connection = ConnectionManager::get('default');
        
        $query = "UPDATE dates
SET is_weekday = CASE WHEN dayofweek(dt) IN (1,7) THEN 0 ELSE 1 END,
	y = YEAR(dt),
	q = quarter(dt),
	m = MONTH(dt),
	d = dayofmonth(dt),
	dw = dayofweek(dt),
	month_name = monthname(dt),
	day_name = dayname(dt),
	w = week(dt)
WHERE is_weekday is null";
        
        $result = $connection->execute($query);
        
        return $result;
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
            ->date('dt')
            ->allowEmpty('dt', 'create');

        $validator
            ->integer('y')
            ->allowEmpty('y');

        $validator
            ->integer('q')
            ->allowEmpty('q');

        $validator
            ->integer('m')
            ->allowEmpty('m');

        $validator
            ->integer('d')
            ->allowEmpty('d');

        $validator
            ->integer('dw')
            ->allowEmpty('dw');

        $validator
            ->allowEmpty('month_name');

        $validator
            ->allowEmpty('day_name');

        $validator
            ->integer('w')
            ->allowEmpty('w');

        $validator
            ->allowEmpty('is_weekday');

        return $validator;
    }
}
