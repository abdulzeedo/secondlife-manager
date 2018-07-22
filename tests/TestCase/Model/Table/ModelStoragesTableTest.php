<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ModelStoragesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ModelStoragesTable Test Case
 */
class ModelStoragesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ModelStoragesTable
     */
    public $ModelStorages;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.model_storages',
        'app.storages',
        'app.phones',
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
        $config = TableRegistry::exists('ModelStorages') ? [] : ['className' => ModelStoragesTable::class];
        $this->ModelStorages = TableRegistry::get('ModelStorages', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ModelStorages);

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
