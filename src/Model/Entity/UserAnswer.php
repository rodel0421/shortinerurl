<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UserAnswer Entity
 *
 * @property int $id
 * @property int $user_test_id
 * @property string $user_id
 * @property int $question_id
 * @property int $answer_id
 * @property string $result
 *
 * @property \App\Model\Entity\UserTest $user_test
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Question $question
 * @property \App\Model\Entity\Answer $answer
 */
class UserAnswer extends Entity
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
