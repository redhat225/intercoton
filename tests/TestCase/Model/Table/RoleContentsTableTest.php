<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RoleContentsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RoleContentsTable Test Case
 */
class RoleContentsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\RoleContentsTable
     */
    public $RoleContents;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.role_contents',
        'app.roles',
        'app.auditor_accounts',
        'app.auditors',
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
        $config = TableRegistry::exists('RoleContents') ? [] : ['className' => RoleContentsTable::class];
        $this->RoleContents = TableRegistry::get('RoleContents', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->RoleContents);

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
