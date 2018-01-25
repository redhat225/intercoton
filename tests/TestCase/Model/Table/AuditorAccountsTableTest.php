<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AuditorAccountsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AuditorAccountsTable Test Case
 */
class AuditorAccountsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AuditorAccountsTable
     */
    public $AuditorAccounts;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.auditor_accounts',
        'app.auditors',
        'app.roles',
        'app.role_contents',
        'app.reports',
        'app.cooperatives',
        'app.zones',
        'app.sessions'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('AuditorAccounts') ? [] : ['className' => AuditorAccountsTable::class];
        $this->AuditorAccounts = TableRegistry::get('AuditorAccounts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AuditorAccounts);

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
