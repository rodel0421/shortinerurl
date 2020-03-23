<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CourseQuestionAnswersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CourseQuestionAnswersTable Test Case
 */
class CourseQuestionAnswersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CourseQuestionAnswersTable
     */
    public $CourseQuestionAnswers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.course_question_answers',
        'app.course_questions',
        'app.course_tests',
        'app.course_question_types',
        'app.choices'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CourseQuestionAnswers') ? [] : ['className' => CourseQuestionAnswersTable::class];
        $this->CourseQuestionAnswers = TableRegistry::get('CourseQuestionAnswers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CourseQuestionAnswers);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
