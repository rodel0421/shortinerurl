<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * EquipmentLink Entity
 *
 * @property int $id
 * @property int $equipment_id
 * @property int $related_equipment
 * @property \Cake\I18n\Time $created
 *
 * @property \App\Model\Entity\Equipment $equipment
 */
class EquipmentLink extends Entity
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
