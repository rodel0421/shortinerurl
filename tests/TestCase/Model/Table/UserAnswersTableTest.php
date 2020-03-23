<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UserAnswersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UserAnswersTable Test Case
 */
class UserAnswersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\UserAnswersTable
     */
    public $UserAnswers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.user_answers',
        'app.user_tests',
        'app.users',
        'app.groups',
        'app.resources',
        'app.facilities',
        'app.bookings',
        'app.bookings_templates',
        'app.client_types',
        'app.booking_fees',
        'app.booking_personnel',
        'app.equipment',
        'app.equipment_types',
        'app.departments',
        'app.register_admins',
        'app.registers',
        'app.register_templates',
        'app.register_classes',
        'app.register_checklists',
        'app.register_forms',
        'app.departments_users',
        'app.leaders',
        'app.user_types',
        'app.certifications',
        'app.validated',
        'app.user_notes',
        'app.trips',
        'app.user_docs',
        'app.user_statuses',
        'app.alerts',
        'app.flags',
        'app.flags_users',
        'app.my_appointments',
        'app.appointments',
        'app.equipment_reservations',
        'app.equipment_status',
        'app.certification_status',
        'app.register_status',
        'app.leads',
        'app.departments_leaders',
        'app.certification_types',
        'app.certification_classes',
        'app.equipment_logs',
        'app.items',
        'app.messages',
        'app.roster_shifts',
        'app.roster_users',
        'app.facilities_users',
        'app.resource_categories',
        'app.resources_tags',
        'app.course_tests',
        'app.questions',
        'app.answers'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('UserAnswers') ? [] : ['className' => UserAnswersTable::class];
        $this->UserAnswers = TableRegistry::get('UserAnswers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UserAnswers);

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
