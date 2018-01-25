<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AuditorsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AuditorsTable Test Case
 */
class AuditorsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AuditorsTable
     */
    public $Auditors;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.auditors',
        'app.auditor_accounts',
        'app.auditors_roles',
        'app.reports',
        'app.cooperatives',
        'app.zones',
        'app.sessions',
        'app.roles',
        'app.role_contents'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Auditors') ? [] : ['className' => AuditorsTable::class];
        $this->Auditors = TableRegistry::get('Auditors', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Auditors);

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
