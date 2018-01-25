<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CooperativesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CooperativesTable Test Case
 */
class CooperativesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CooperativesTable
     */
    public $Cooperatives;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.cooperatives',
        'app.zones',
        'app.reports',
        'app.auditor_accounts',
        'app.auditors',
        'app.roles',
        'app.role_contents',
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
        $config = TableRegistry::exists('Cooperatives') ? [] : ['className' => CooperativesTable::class];
        $this->Cooperatives = TableRegistry::get('Cooperatives', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Cooperatives);

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
