<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CourseEnrolledUser Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $course_id
 * @property \Cake\I18n\FrozenDate $date_start
 * @property \Cake\I18n\FrozenDate $date_complete
 * @property string $status
 * @property bool $active
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Course $course
 * @property \App\Model\Entity\CourseEnrolledModule[] $course_enrolled_modules
 * @property \App\Model\Entity\CourseEnrolledTest[] $course_enrolled_tests
 */
class CourseEnrolledUser extends Entity
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
