<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EquipmentReservations Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Equipment
 * @property \Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\EquipmentReservation get($primaryKey, $options = [])
 * @method \App\Model\Entity\EquipmentReservation newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\EquipmentReservation[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\EquipmentReservation|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EquipmentReservation patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\EquipmentReservation[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\EquipmentReservation findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EquipmentReservationsTable extends Table
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

        $this->table('equipment_reservations');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Equipment', [
            'foreignKey' => 'equipment_id',
            'joinType' => 'INNER'
        ]);
        
        $this->belongsTo('Trips', [
            'foreignKey' => 'tableid',
            'conditions'=>['table'=>'Trips']
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id'
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
            ->allowEmpty('table');

        $validator
            ->integer('tableid')
            ->allowEmpty('tableid');

        $validator
            ->allowEmpty('type');

        $validator
            ->allowEmpty('notes');

        $validator->add('start', 
            ['dateTime'=>[
                'rule' => ['dateTime', ['ymd','dmy']],
                'on' => function ($context) {
                    return isset($context['data']['all_day']) && !$context['data']['all_day'];
                }
            ],
            'date'=>    [
                'rule' => ['date', ['ymd','dmy']],
                'on' => function ($context) {
                    return !isset($context['data']['all_day']) || $context['data']['all_day'];
                }
            ]
        ])->requirePresence('start', 'create')
        ->notEmpty('start');

        $validator->add('end', 
            ['dateTime'=>[
                'rule' => ['dateTime', ['ymd','dmy']],
                'message' => 'Must be valid date time format',
                'on' => function ($context) {
                    return isset($context['data']['all_day']) && !$context['data']['all_day'];
                }
            ],
            'date'=>    [
                'rule' => ['date', ['ymd','dmy']],
                'message' => 'Must be valid date format',
                'on' => function ($context) {
                    return !isset($context['data']['all_day']) || $context['data']['all_day'];
                }
                
            ],
            'afterStart' => [
                'rule' => [$this,'checkSiteStartDate'],
                'message' => 'End datetime must be after Start datetime',
                'last' => true
            ]
        ])->requirePresence('end', 'create')
        ->notEmpty('end');
        
        $validator
            ->boolean('all_day')
            ->requirePresence('all_day', 'create')
            ->notEmpty('all_day');

        $validator
            ->boolean('approved')
            ->allowEmpty('approved');
        
        $validator
            ->boolean('returned')
            ->allowEmpty('returned');

        return $validator;
    }
    
    public static function checkSiteStartDate($value, $context) {

        if (isset($context['data']['end']) && isset($context['data']['start'])) {
            $start =  strtotime($context['data']['start']);
            $end = strtotime($context['data']['end']);

            return $end >= $start;
        }
        return true;
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
        $rules->add($rules->existsIn(['equipment_id'], 'Equipment'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
    
    /*
     * $equipment_ids is array of  equipment_ids
     * $start_date and $end_date string date mysql format Y-m-d
     *     */
    public function avaiability($equipment_ids,$start_date,$end_date){
        if(empty($equipment_ids) ||
            !preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$start_date) ||
            !preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$end_date)
                ){
            return ['ERROR'=>'Incorrect Dates'];
        }
        $avaiability = $this->find();
        
        $approvedCase = $avaiability->newExpr()
            ->addCase(
                $avaiability->newExpr()->add(['EquipmentReservations.approved' => 1]),
                ['EquipmentReservations.qty',0],
                'integer'
            );
        $pendingCase = $avaiability->newExpr()
            ->addCase(
                $avaiability->newExpr()->add(['EquipmentReservations.approved' => 0]),
                ['EquipmentReservations.qty',0],
                'integer'
            );
        
        $avaiability->select([
            'EquipmentReservations.equipment_id',
            'Dates.dt',
            'num_approved'=>$avaiability->func()->sum('case when EquipmentReservations.approved = 1 then EquipmentReservations.qty else 0 end'),
            'pending'=>$avaiability->func()->sum('case when EquipmentReservations.approved IS NULL then EquipmentReservations.qty else 0 end')
                ])
                ->hydrate(false)
                ->join(['Dates'=>[
                    'table'=>'dates',
                    'type'=>'LEFT',
                    'conditions'=>'Dates.dt between EquipmentReservations.`start` and EquipmentReservations.`end`'
                ]])
                ->where(function ($exp, $q) use ($equipment_ids,$start_date,$end_date)  {
                    return [
                        'EquipmentReservations.equipment_id IN'=>$equipment_ids,
                        $exp->between('Dates.dt', $start_date, $end_date)];
                })
                ->group(['EquipmentReservations.equipment_id','Dates.dt']);
        
        return \Cake\Utility\Hash::combine($avaiability->toArray(),'{n}.Dates.dt','{n}','{n}.equipment_id');
    }
    
    
    public function avaiability_time($equipment_ids,$start_date,$end_date,$start_time,$end_time){
        if(empty($equipment_ids) ||
            !preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$start_date) ||//Valid date
            !preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$end_date)||//Valid date
            !(($start_time >= 0 && $start_time <= 24)) || // Valid time
            !(($end_time >= 0 && $end_time <= 24)) // Valid time
                ){
            return ['ERROR'=>'Incorrect Dates'];
        }
        
        $start_date_time = date('Y-m-d H:i:s', strtotime($start_date) + ($start_time * 60 * 60) );
        $end_date_time = date('Y-m-d H:i:s', strtotime($end_date) + (($end_time * 60 * 60) - 1) );
        if($start_date_time >= $end_date_time){// End date after start
            return ['ERROR'=>'Incorrect Dates'];
        }
        
        
        $connection = ConnectionManager::get('default');
        
$query = <<<EOD
SELECT 
  `EquipmentReservations`.`equipment_id` AS `equipment_id`, 
  `Dates`.`dt` AS `dt`, 
  (
    SUM(
      case when EquipmentReservations.approved = 1 then EquipmentReservations.qty else 0 end
    )
  ) AS `num_approved`, 
  (
    SUM(
      case when EquipmentReservations.approved IS NULL then EquipmentReservations.qty else 0 end
    )
  ) AS `pending` 
FROM 
  `equipment_reservations` `EquipmentReservations` 
  LEFT JOIN (Select STR_TO_DATE(CONCAT(`Dates`.dt, ' ', hours.time_hour), '%Y-%m-%d %H:%i') as dt from dates as Dates
JOIN
(SELECT '00:00' AS time_hour
UNION ALL SELECT '01:00'
UNION ALL SELECT '02:00'
UNION ALL SELECT '03:00'
UNION ALL SELECT '04:00'
UNION ALL SELECT '05:00'
UNION ALL SELECT '06:00'
UNION ALL SELECT '07:00'
UNION ALL SELECT '08:00'
UNION ALL SELECT '09:00'
UNION ALL SELECT '10:00'
UNION ALL SELECT '11:00'
UNION ALL SELECT '12:00'
UNION ALL SELECT '13:00'
UNION ALL SELECT '14:00'
UNION ALL SELECT '15:00'
UNION ALL SELECT '16:00'
UNION ALL SELECT '17:00'
UNION ALL SELECT '18:00'
UNION ALL SELECT '19:00'
UNION ALL SELECT '20:00'
UNION ALL SELECT '21:00'
UNION ALL SELECT '22:00'
UNION ALL SELECT '23:00') as hours 
WHERE 
  (
    `Dates`.`dt` BETWEEN :start_date AND :end_date
  ) 
) as Dates ON Dates.dt >= EquipmentReservations.`start` AND
  		Dates.dt < EquipmentReservations.`end`
WHERE 
  (
    `EquipmentReservations`.`equipment_id` in (:equipment_ids) AND 
    `Dates`.`dt` BETWEEN :start_date_time AND :end_date_time
  ) 
GROUP BY 
  `EquipmentReservations`.`equipment_id`, `Dates`.`dt`
EOD;
    
    $query = str_replace(':equipment_ids',implode(',',$equipment_ids),$query);

    $avaiability = $connection->execute($query,[
           // 'equipment_ids'=>implode(',',$equipment_ids),
            'start_date'=>$start_date,
            'end_date'=>$end_date,
            'start_date_time'=>$start_date_time,
            'end_date_time'=>$end_date_time
            ])->fetchAll('assoc');
        
        
        //debug(\Cake\Utility\Hash::combine($avaiability,'{n}.dt','{n}','{n}.equipment_id'));
        //die();
        return \Cake\Utility\Hash::combine($avaiability,'{n}.dt','{n}','{n}.equipment_id');
    }
}
