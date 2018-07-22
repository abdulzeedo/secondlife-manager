<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ReturnsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ReturnsTable Test Case
 */
class ReturnsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ReturnsTable
     */
    public $Returns;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.returns',
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
        $config = TableRegistry::exists('Returns') ? [] : ['className' => ReturnsTable::class];
        $this->Returns = TableRegistry::get('Returns', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Returns);

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
