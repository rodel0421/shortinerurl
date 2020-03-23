<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Module Entity
 *
 * @property int $id
 * @property int $courses_id
 * @property int $machine_types_id
 * @property int $resources_id
 * @property int $test_id
 * @property string $full_name
 *
 * @property \App\Model\Entity\Course $course
 * @property \App\Model\Entity\MachineType $machine_type
 * @property \App\Model\Entity\Resource $resource
 * @property \App\Model\Entity\Test $test
 * @property \App\Model\Entity\EnrolledModule[] $enrolled_modules
 */
class Module extends Entity
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
