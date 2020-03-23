<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AllowedDomainsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AllowedDomainsTable Test Case
 */
class AllowedDomainsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AllowedDomainsTable
     */
    public $AllowedDomains;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.allowed_domains'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('AllowedDomains') ? [] : ['className' => AllowedDomainsTable::class];
        $this->AllowedDomains = TableRegistry::get('AllowedDomains', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AllowedDomains);

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
