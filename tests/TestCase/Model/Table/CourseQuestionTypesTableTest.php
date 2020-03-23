<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CourseQuestionTypesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CourseQuestionTypesTable Test Case
 */
class CourseQuestionTypesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CourseQuestionTypesTable
     */
    public $CourseQuestionTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.course_question_types',
        'app.course_questions',
        'app.course_tests'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CourseQuestionTypes') ? [] : ['className' => CourseQuestionTypesTable::class];
        $this->CourseQuestionTypes = TableRegistry::get('CourseQuestionTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CourseQuestionTypes);

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
}
