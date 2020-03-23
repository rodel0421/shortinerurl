<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ResourcesTag Entity
 *
 * @property int $resource_id
 * @property int $resource_category_id
 *
 * @property \App\Model\Entity\Resource $resource
 * @property \App\Model\Entity\ResourceCategory $resource_category
 */
class ResourcesTag extends Entity
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
        'resource_id' => false,
        'resource_category_id' => false
    ];
}
