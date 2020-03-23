<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Date Entity
 *
 * @property \Cake\I18n\Time $dt
 * @property int $y
 * @property int $q
 * @property int $m
 * @property int $d
 * @property int $dw
 * @property string $month_name
 * @property string $day_name
 * @property int $w
 * @property string|resource $is_weekday
 */
class Date extends Entity
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
        'dt' => false
    ];
}
