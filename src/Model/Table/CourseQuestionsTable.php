<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Event\Event;
use ArrayObject;
/**
 * CourseQuestions Model
 *
 * @property \App\Model\Table\CourseTestsTable|\Cake\ORM\Association\BelongsTo $CourseTests
 *
 * @method \App\Model\Entity\CourseQuestion get($primaryKey, $options = [])
 * @method \App\Model\Entity\CourseQuestion newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CourseQuestion[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CourseQuestion|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CourseQuestion patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CourseQuestion[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CourseQuestion findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CourseQuestionsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('course_questions');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('CourseTests', [
            'foreignKey'    => 'course_test_id',
            'joinType'      => 'INNER'
        ]);
        $this->belongsTo('CourseQuestionTypes', [
            'foreignKey' => 'course_question_type_id',
        ]);

        $this->belongsToMany('Answers', [
            'className'    => 'CourseQuestionChoices',
            'joinTable'    => 'course_question_answers',
            'targetForeignKey' => 'course_question_choice_id',
            'saveStrategy' => 'replace',
            'dependant' => true
        ]);

        $this->hasMany('CourseQuestionChoices', [
            'dependant' => true,
        ]);

        $this->hasMany('UserAnswers',[
            'foreignKey' => 'question_id'
        ]);

        $this->addBehavior('ADmad/Sequence.Sequence', [
            'order' => 'position', // Field to use to store integer sequence. Default "position".
            'scope' => ['course_test_id'], // Array of field names to use for grouping records. Default [].
            'start' => 1, // Initial value for sequence. Default 1.
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->requirePresence('question', 'create')
            ->notEmpty('question');

        $validator
            ->requirePresence('course_question_type_id', 'create')
            ->notEmpty('course_question_type_id');

        $validator
            ->allowEmpty('answer');

        // $validator
        //     ->integer('position')
        //     ->requirePresence('position', 'create')
        //     ->notEmpty('position');

        $validator
            ->boolean('active')
            ->requirePresence('active', 'create')
            ->notEmpty('active');

        $validator
            ->allowEmpty('img')
            ->add('img', [
                'validExtension' => [
                    'rule' => ['extension',['jpeg', 'png', 'jpg']],
                    'message' => __('These files extension are allowed: .png .jpeg .jpg')
                ]
            ]);

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['course_test_id'], 'CourseTests'));
        return $rules;
    }

    public function beforeMarshal(Event $event, ArrayObject $data, ArrayObject $options){
        $typeID = $data['course_question_type_id'];
        if($typeID == 1 || $typeID == 3)
        {
            if(array_key_exists('choices', $data)){
                $choices_array = [];
                foreach($data['choices'] as $choice){
                    array_push(
                        $choices_array,
                        array(
                            'value' => $choice
                        )
                    );
                }
                $data['course_question_choices'] = $choices_array;
                unset($data['choices']);
            }
            if(array_key_exists('answers', $data)){
                $answer_array = [];
                foreach($data['answers'] as $answer)
                {
                    array_push($answer_array, array('id' => $answer));
                }
                unset($data['answers']);
                $data['img'] = []; 
                $data['answers'] = $answer_array;
            }
        }
    }

}
