<?php

/**
 * GetOrders test case.
 */
use App\Model\GetOrders;
use App\Test\TestCase\ApplicationTest;
use Cake\Core\Configure;
use Cake\TestSuite\TestCase;

class GetOrdersTest extends TestCase
{

    /**
     *
     * @var GetOrders
     */
    private $getOrders;

    /**
     * Prepares the environment before running a test.
     */
    public function setUp()
    {
        parent::setUp();
        
        // TODO Auto-generated GetOrdersTest::setUp()
        $this->getOrders = new GetOrders();
        
    }

    /**
     * Cleans up the environment after running a test.
     */
    public function tearDown()
    {
        // TODO Auto-generated GetOrdersTest::tearDown()
        $this->getOrders = null;
        
        parent::tearDown();
    }

    /**
     * Constructs the test case.
     */
    public function __construct()
    {
        // TODO Auto-generated constructor
    }

    /**
     * Tests GetOrders->__constructor()
     */
    public function test__constructor()
    {
       
        $this->assertTrue($this->getOrders->debug());
    }
    public function testApiKeyConfig() {
        
        $this->assertNull(Configure::read('blog'));
    }
}

