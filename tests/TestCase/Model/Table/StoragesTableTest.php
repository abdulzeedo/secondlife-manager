<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\StoragesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\StoragesTable Test Case
 */
class StoragesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\StoragesTable
     */
    public $Storages;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.storages',
        'app.model_storages',
        'app.models',
        'app.manufacturers',
        'app.model_colours',
        'app.colours',
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
        $config = TableRegistry::exists('Storages') ? [] : ['className' => StoragesTable::class];
        $this->Storages = TableRegistry::get('Storages', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Storages);

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
