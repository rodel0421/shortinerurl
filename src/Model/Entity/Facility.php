<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Facility Entity
 *
 * @property int $id
 * @property string $title
 * @property string $abv
 * @property string $description
 * @property string $notes
 * @property string $bookings_email
 * @property string $users_email
 * @property string $enabled_areas
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\Booking[] $bookings
 * @property \App\Model\Entity\BookingsTemplate[] $bookings_templates
 * @property \App\Model\Entity\ClientType[] $client_types
 * @property \App\Model\Entity\Equipment[] $equipment
 * @property \App\Model\Entity\Item[] $items
 * @property \App\Model\Entity\Message[] $messages
 * @property \App\Model\Entity\Resource[] $resources
 * @property \App\Model\Entity\RosterShift[] $roster_shifts
 * @property \App\Model\Entity\RosterUser[] $roster_users
 * @property \App\Model\Entity\User[] $users
 */
class Facility extends Entity
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
