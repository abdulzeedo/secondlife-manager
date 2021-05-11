<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ItemReturnsStatusTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ItemReturnsStatusTable Test Case
 */
class ItemReturnsStatusTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ItemReturnsStatusTable
     */
    public $ItemReturnsStatus;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.item_returns_status',
        'app.item_returns'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ItemReturnsStatus') ? [] : ['className' => ItemReturnsStatusTable::class];
        $this->ItemReturnsStatus = TableRegistry::get('ItemReturnsStatus', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ItemReturnsStatus);

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
