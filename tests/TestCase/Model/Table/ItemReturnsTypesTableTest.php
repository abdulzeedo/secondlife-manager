<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ItemReturnsTypesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ItemReturnsTypesTable Test Case
 */
class ItemReturnsTypesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ItemReturnsTypesTable
     */
    public $ItemReturnsTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.item_returns_types'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ItemReturnsTypes') ? [] : ['className' => ItemReturnsTypesTable::class];
        $this->ItemReturnsTypes = TableRegistry::get('ItemReturnsTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ItemReturnsTypes);

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
