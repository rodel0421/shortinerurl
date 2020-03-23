<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CourseModule Entity
 *
 * @property int $id
 * @property int $course_id
 * @property int $course_machine_types_id
 * @property int $resources_id
 * @property string $name
 * @property string $code
 * @property string $description
 * @property bool $active
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Course $course
 * @property \App\Model\Entity\CourseMachineType $course_machine_type
 * @property \App\Model\Entity\Resource $resource
 * @property \App\Model\Entity\CourseEnrolledModule[] $course_enrolled_modules
 * @property \App\Model\Entity\CourseTest[] $course_tests
 */
class CourseModule extends Entity
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
