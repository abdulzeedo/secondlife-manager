<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SupplierOrdersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SupplierOrdersTable Test Case
 */
class SupplierOrdersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SupplierOrdersTable
     */
    public $SupplierOrders;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.supplier_orders',
        'app.suppliers',
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
        $config = TableRegistry::exists('SupplierOrders') ? [] : ['className' => SupplierOrdersTable::class];
        $this->SupplierOrders = TableRegistry::get('SupplierOrders', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SupplierOrders);

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
