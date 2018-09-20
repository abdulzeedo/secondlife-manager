<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ItemReturnsTypeStatusTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ItemReturnsTypeStatusTable Test Case
 */
class ItemReturnsTypeStatusTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ItemReturnsTypeStatusTable
     */
    public $ItemReturnsTypeStatus;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.item_returns_type_status',
        'app.item_returns_types',
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
        $config = TableRegistry::exists('ItemReturnsTypeStatus') ? [] : ['className' => ItemReturnsTypeStatusTable::class];
        $this->ItemReturnsTypeStatus = TableRegistry::get('ItemReturnsTypeStatus', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ItemReturnsTypeStatus);

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
