<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ManufacturersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ManufacturersTable Test Case
 */
class ManufacturersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ManufacturersTable
     */
    public $Manufacturers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.manufacturers',
        'app.models',
        'app.model_colours',
        'app.colours',
        'app.phones',
        'app.storages',
        'app.model_storages'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Manufacturers') ? [] : ['className' => ManufacturersTable::class];
        $this->Manufacturers = TableRegistry::get('Manufacturers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Manufacturers);

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
