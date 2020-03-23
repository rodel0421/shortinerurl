<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CourseEnrolledModule Entity
 *
 * @property int $id
 * @property int $course_enrolled_user_id
 * @property int $course_module_id
 * @property string $status
 * @property \Cake\I18n\FrozenDate $date_complete
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\CourseEnrolledUser $course_enrolled_user
 * @property \App\Model\Entity\CourseModule $course_module
 */
class CourseEnrolledModule extends Entity
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
