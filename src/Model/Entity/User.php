<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Collection\Collection;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Utility\Hash;

/**
 * User Entity
 *
 * @property int $id
 * @property int $group_id
 * @property int $facility_id
 * @property string $given_name
 * @property string $surname
 * @property string $email
 * @property \Cake\I18n\Time $dob
 * @property string $phone
 * @property string $mobile
 * @property string $emergency_contact_name
 * @property string $emergency_contact_number
 * @property string $position
 * @property string $department
 * @property string $address
 * @property string $company_name
 * @property string $company_contact
 * @property string $company_address
 * @property string $supervisor
 * @property string $supervisor_email
 * @property string $supervisor_phone
 * @property string $username
 * @property string $account_type
 * @property string $password
 * @property string $key
 * @property string $profile_url
 * @property string $facilities_access
 * @property bool $admin_only
 * @property bool $active
 * @property bool $account_verified
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\Group $group
 * @property \App\Model\Entity\Facility[] $facilities
 * @property \App\Model\Entity\BookingLog[] $booking_logs
 * @property \App\Model\Entity\BookingPersonnel[] $booking_personnels
 * @property \App\Model\Entity\Booking[] $bookings
 * @property \App\Model\Entity\Certification[] $certifications
 * @property \App\Model\Entity\ContactLog[] $contact_logs
 * @property \App\Model\Entity\Equipment[] $equipment
 * @property \App\Model\Entity\EquipmentLog[] $equipment_logs
 * @property \App\Model\Entity\Form[] $forms
 * @property \App\Model\Entity\Message[] $messages
 * @property \App\Model\Entity\Photo[] $photos
 * @property \App\Model\Entity\Register[] $registers
 * @property \App\Model\Entity\Resource[] $resources
 * @property \App\Model\Entity\RosterUser[] $roster_users
 * @property \App\Model\Entity\TripLog[] $trip_logs
 * @property \App\Model\Entity\TripPersonnel[] $trip_personnels
 * @property \App\Model\Entity\Trip[] $trips
 * @property \App\Model\Entity\UserDoc[] $user_docs
 * @property \App\Model\Entity\UserStatus[] $user_statuses
 * @property \App\Model\Entity\Department[] $departments
 * @property \App\Model\Entity\Flag[] $flags
 */
class User extends Entity
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

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];
        
    protected function _setPassword($password){
        return (new DefaultPasswordHasher)->hash($password);
    }
    
    protected function _getFlagString()
    {
        if (isset($this->_properties['flag_string'])) {
            return $this->_properties['flag_string'];
        }
        if (empty($this->flags)) {
            return '';
        }
        $flags = new Collection($this->flags);
        $str = $flags->reduce(function ($string, $flag) {
            return $string . $flag->title . ', ';
        }, '');
        return trim($str, ', ');
    }    
    
    protected function _getFlag()
    {
        if (isset($this->_properties['flag'])) {
            return $this->_properties['flag'];
        }
        if (empty($this->flags)) {
            return '';
        }
        
        $flags = new Collection($this->flags);
        
        return Hash::extract($this->flags, '{n}.title');
    }
}
