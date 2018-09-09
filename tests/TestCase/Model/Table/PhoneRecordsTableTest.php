<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PhoneRecordsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PhoneRecordsTable Test Case
 */
class PhoneRecordsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PhoneRecordsTable
     */
    public $PhoneRecords;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.phone_records',
        'app.users',
        'app.phones'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('PhoneRecords') ? [] : ['className' => PhoneRecordsTable::class];
        $this->PhoneRecords = TableRegistry::get('PhoneRecords', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PhoneRecords);

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
