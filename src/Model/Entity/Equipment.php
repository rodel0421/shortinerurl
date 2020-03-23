<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Equipment Entity
 *
 * @property int $id
 * @property int $facility_id
 * @property string $type
 * @property int $equipment_type_id
 * @property int $department_id
 * @property string $asset
 * @property string $make
 * @property string $model
 * @property string $serial
 * @property string $part_number
 * @property string $notes
 * @property \Cake\I18n\Time $purchased
 * @property string $type_data
 * @property string $issued_to
 * @property float $cost
 * @property string $cost_centre
 * @property int $depreciated_over_years
 * @property int $user_id
 * @property \Cake\I18n\Time $last_service
 * @property \Cake\I18n\Time $next_service
 * @property bool $active
 * @property int $status
 * @property \Cake\I18n\Time $status_date
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\Facility $facility
 * @property \App\Model\Entity\EquipmentType $equipment_type
 * @property \App\Model\Entity\Department $department
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\EquipmentLog[] $equipment_logs
 * @property \App\Model\Entity\ServiceLog[] $service_logs
 */
class Equipment extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}
