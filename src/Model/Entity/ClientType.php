<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ClientType Entity
 *
 * @property int $id
 * @property string $title
 * @property int $facility_id
 * @property string $description
 * @property int $active
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\Facility $facility
 * @property \App\Model\Entity\BookingFee[] $booking_fees
 * @property \App\Model\Entity\BookingPersonnel[] $booking_personnel
 */
class ClientType extends Entity
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
