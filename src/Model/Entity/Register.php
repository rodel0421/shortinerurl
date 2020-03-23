<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Register Entity
 *
 * @property int $id
 * @property int $register_template_id
 * @property int $user_id
 * @property int $register_class_id
 * @property int $department_id
 * @property string $status
 * @property string $notes
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\RegisterTemplate $register_template
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\RegisterClass $register_class
 * @property \App\Model\Entity\Department $department
 * @property \App\Model\Entity\RegisterChecklist[] $register_checklists
 * @property \App\Model\Entity\RegisterForm[] $register_forms
 */
class Register extends Entity
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
