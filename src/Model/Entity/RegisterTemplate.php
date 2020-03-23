<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * RegisterTemplate Entity
 *
 * @property int $id
 * @property string $name
 * @property string $about
 * @property string $form_type
 * @property string $checklists
 * @property string $required_certifications
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\RegisterAdmin[] $register_admins
 * @property \App\Model\Entity\RegisterClass[] $register_classes
 * @property \App\Model\Entity\Register[] $registers
 */
class RegisterTemplate extends Entity
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
