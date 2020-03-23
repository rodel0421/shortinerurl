<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ModulesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ModulesTable Test Case
 */
class ModulesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ModulesTable
     */
    public $Modules;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.modules',
        'app.courses',
        'app.enrolled_users',
        'app.machine_types',
        'app.resources',
        'app.users',
        'app.groups',
        'app.user_types',
        'app.certifications',
        'app.validated',
        'app.user_notes',
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
        'app.equipment_logs',
        'app.certification_types',
        'app.certification_classes',
        'app.facilities',
        'app.bookings',
        'app.bookings_templates',
        'app.client_types',
        'app.booking_fees',
        'app.booking_personnel',
        'app.items',
        'app.messages',
        'app.roster_shifts',
        'app.roster_users',
        'app.facilities_users',
        'app.resource_categories',
        'app.resources_tags',
        'app.tests',
        'app.enrolled_modules',
        'app.test'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Modules') ? [] : ['className' => ModulesTable::class];
        $this->Modules = TableRegistry::get('Modules', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Modules);

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
