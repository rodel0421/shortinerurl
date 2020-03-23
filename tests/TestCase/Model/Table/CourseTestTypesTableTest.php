<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CourseTestTypesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CourseTestTypesTable Test Case
 */
class CourseTestTypesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CourseTestTypesTable
     */
    public $CourseTestTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.course_test_types',
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
        $config = TableRegistry::exists('CourseTestTypes') ? [] : ['className' => CourseTestTypesTable::class];
        $this->CourseTestTypes = TableRegistry::get('CourseTestTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CourseTestTypes);

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
