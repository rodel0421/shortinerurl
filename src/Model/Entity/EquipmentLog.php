<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * EquipmentLog Entity
 *
 * @property int $id
 * @property int $equipment_id
 * @property int $user_id
 * @property string $type
 * @property string $notes
 * @property \Cake\I18n\Time $date
 * @property float $cost
 * @property string $file_url
 * @property string $file_type
 * @property string $file_ext
 * @property string $file_size
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\Equipment $equipment
 * @property \App\Model\Entity\User $user
 */
class EquipmentLog extends Entity
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
