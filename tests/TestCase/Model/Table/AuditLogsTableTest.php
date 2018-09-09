<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AuditLogsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AuditLogsTable Test Case
 */
class AuditLogsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AuditLogsTable
     */
    public $AuditLogs;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.audit_logs'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('AuditLogs') ? [] : ['className' => AuditLogsTable::class];
        $this->AuditLogs = TableRegistry::get('AuditLogs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AuditLogs);

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
