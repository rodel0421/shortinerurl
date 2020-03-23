<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CertificationType Entity
 *
 * @property int $id
 * @property string $category
 * @property string $type
 * @property string $name
 * @property int $certification_class_id
 * @property string $description
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\CertificationClass $certification_class
 * @property \App\Model\Entity\Certification[] $certifications
 */
class CertificationType extends Entity
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
