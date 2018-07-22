<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ConnectedPhonesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ConnectedPhonesTable Test Case
 */
class ConnectedPhonesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ConnectedPhonesTable
     */
    public $ConnectedPhones;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.connected_phones',
        'app.phones',
        'app.users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ConnectedPhones') ? [] : ['className' => ConnectedPhonesTable::class];
        $this->ConnectedPhones = TableRegistry::get('ConnectedPhones', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ConnectedPhones);

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
