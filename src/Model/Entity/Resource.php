<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Collection\Collection;
use Cake\Utility\Hash;

/**
 * Resource Entity
 *
 * @property int $id
 * @property string $title
 * @property int $user_id
 * @property string $description
 * @property int $facility_id
 * @property int $group_id
 * @property bool $home
 * @property string $doc
 * @property string $doc_ext
 * @property string $doc_type
 * @property string $doc_size
 * @property string $notes
 * @property string $link
 * @property int $parent_id
 * @property int $lft
 * @property int $rght
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Facility $facility
 * @property \App\Model\Entity\Group $group
 * @property \App\Model\Entity\ParentResource $parent_resource
 * @property \App\Model\Entity\ChildResource[] $child_resources
 */
class Resource extends Entity
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
        'id' => false,
        'category_string' => true
    ];
    
    protected function _getCategoryString()
    {
        if (isset($this->_properties['category_string'])) {
            return $this->_properties['category_string'];
        }
        if (empty($this->resource_categories)) {
            return '';
        }
        $tags = new Collection($this->resource_categories);
        $str = $tags->reduce(function ($string, $tag) {
            return $string . $tag->name . ', ';
        }, '');
        return trim($str, ', ');
    }
    
    protected function _getCategories()
    {
        if (isset($this->_properties['categories'])) {
            return $this->_properties['categories'];
        }
        if (empty($this->resource_categories)) {
            return '';
        }
        
        $tags = new Collection($this->resource_categories);
        
        return Hash::extract($this->resource_categories, '{n}.name');
    }
}
