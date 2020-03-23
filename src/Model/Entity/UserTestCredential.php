<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UserTestCredential Entity
 *
 * @property int $id
 * @property int $user_test_id
 * @property string $login_id
 * @property string $login_pin
 *
 * @property \App\Model\Entity\UserTest $user_test
 * @property \App\Model\Entity\Login $login
 */
class UserTestCredential extends Entity
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

    protected $_virtual = ['open_until', 'timezone'];


    public function _getOpenUntil(){
        $open_until = new \DateTime(date_format($this->date_opened, 'Y-m-d H:i:s'));
        $open_until->add(new \DateInterval("PT8H"));
        $open_until = $open_until->format('Y-m-d H:i:s');
        return $open_until;
    }

    public function _getTimezone(){
        $timezone = $this->date_opened->getTimezone()->getName();
        return $timezone;
    }

}
