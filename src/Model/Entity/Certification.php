<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Certification Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $certification_type_id
 * @property string $issuer
 * @property \Cake\I18n\Time $issued
 * @property \Cake\I18n\Time $expires
 * @property int $validated_by
 * @property \Cake\I18n\Time $validated_date
 * @property bool $valid
 * @property string $file_name
 * @property string $file_url
 * @property string $mime_type
 * @property string $filesize
 * @property string $extension
 * @property string $notes
 * @property bool $active
 * @property int $status
 * @property \Cake\I18n\Time $status_date
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\CertificationType $certification_type
 */
class Certification extends Entity
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
