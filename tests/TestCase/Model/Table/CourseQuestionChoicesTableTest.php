<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CourseQuestionChoicesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CourseQuestionChoicesTable Test Case
 */
class CourseQuestionChoicesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CourseQuestionChoicesTable
     */
    public $CourseQuestionChoices;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.course_question_choices',
        'app.course_questions',
        'app.course_tests',
        'app.course_question_types'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CourseQuestionChoices') ? [] : ['className' => CourseQuestionChoicesTable::class];
        $this->CourseQuestionChoices = TableRegistry::get('CourseQuestionChoices', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CourseQuestionChoices);

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
