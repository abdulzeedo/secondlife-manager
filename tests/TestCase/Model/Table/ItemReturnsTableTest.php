<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ItemReturnsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ItemReturnsTable Test Case
 */
class ItemReturnsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ItemReturnsTable
     */
    public $ItemReturns;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.item_returns',
        'app.phones',
        'app.storages',
        'app.model_storages',
        'app.models',
        'app.manufacturers',
        'app.model_colours',
        'app.colours'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ItemReturns') ? [] : ['className' => ItemReturnsTable::class];
        $this->ItemReturns = TableRegistry::get('ItemReturns', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ItemReturns);

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
