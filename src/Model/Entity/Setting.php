<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Setting Entity
 *
 * @property int $id
 * @property string $name
 * @property string $abv
 * @property string $abn
 * @property string $contact_email
 * @property string $postal_address
 * @property string $billing_email
 * @property int $client_number
 * @property string $logo
 * @property string $favicon
 * @property string $auth_domain_csv
 * @property int $email_disabled
 * @property string $status
 * @property \Cake\I18n\Time $expires
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class Setting extends Entity
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
