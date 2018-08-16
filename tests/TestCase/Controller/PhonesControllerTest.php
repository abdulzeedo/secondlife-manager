<?php
namespace App\Test\TestCase\Controller;

use App\Controller\PhonesController;
use App\Model\Entity\Transaction;
use Cake\I18n\Date;
use Cake\I18n\Time;
use Cake\ORM\Entity;
use Cake\ORM\Query;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestCase;
use Controller;

/**
 * App\Controller\PhonesController Test Case
 */
class PhonesControllerTest extends IntegrationTestCase
{

    public function setUp()
    {
        parent::setUp();
        $this->session([
            'Auth' => [
                'User' => [
                    'id' => 1,
                    'email' => 'testing'
                    // other keys.
                ]
            ]
        ]);
    }
    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.phones',
        'app.storages',
        'app.model_storages',
        'app.models',
        'app.manufacturers',
        'app.model_colours',
        'app.colours',
        'app.item_returns',
        'app.supplier_orders',
        'app.transactions',
        'app.customers',
        'app.suppliers',
        'app.users',
        'app.repairs'
    ];



    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->get('/phones');
        $this->assertResponseOk();
    }
    public function testIndexQuery()
    {
        $imiei = '12345';
        $phones = TableRegistry::get('Phones');
        $phone = $phones->find('all')->where(['imiei' => $imiei])->first();

        $this->get('/phones?q=' . $imiei);
        $this->assertResponseOk();
        $this->assertResponseContains($imiei);
        $this->assertResponseContains($phone->serial_number);
        debug();
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {

        $this->get('/phones/view/1');
        $this->assertResponseOk();

    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    public function testAddTransactionsModalFirstTransaction()
    {
       $data = [
            'customer_id' => '1',
            'phones' => [
                '_ids' => ['1', '2']
            ]
        ];

        $this->post('/phones/addTransactionsModal', $data);
        $this->assertResponseOk();

    }
    public function testAddTransactionsModalWithDoubleTransactionAndNoReturn()
    {
        $data = [
            'customer_id' => '1',
            'phones' => [
                '_ids' => ['1', '2']
            ]
        ];

        $this->post('/phones/addTransactionsModal', $data);

        $this->assertResponseOk();
        $data = [
            'customer_id' => '1',
            'phones' => [
                '_ids' => ['1', '2']
            ]
        ];

        $this->post('/phones/addTransactionsModal', $data);
        $response = [
          "errors" => [
              "phones" => [
                  ["phone" => [
                      "id" => 1,
                      "message" => "The phone has already been set as sold. Add a return or edit it from its view/edit page. Or simply delete it."]
                  ],
                  ["phone" => [
                      "id" => 2,
                      "message" => "The phone has already been set as sold. Add a return or edit it from its view/edit page. Or simply delete it."]
                  ]
              ]
          ]
        ];
        $expectedResponse = json_encode($response, JSON_PRETTY_PRINT);
        $this->assertResponseEquals($expectedResponse);
        $this->assertResponseCode(400);
    }

    public function testAddTransactionsModalWithDoubleTransactionAndReturn()
    {
        $data = [
            'customer_id' => '1',
            'phones' => [
                '_ids' => ['1', '2']
            ]
        ];
        $this->post('/phones/addTransactionsModal', $data);
        $this->assertResponseOk();

        $returnTable = TableRegistry::get('ItemReturns');
        $returnData = ["item_id" => "1", "refund" => "0", "reason" => "Lorem",
                        "status" => "boh"];

        $return0 = $returnTable->newEntity($returnData);
        $returnData["item_id"] = "2";
        $return1 = $returnTable->newEntity($returnData);

        $returnTable->saveOrFail($return0);
        $returnTable->saveOrFail($return1);

        $data = [
            'customer_id' => '1',
            'phones' => [
                '_ids' => ['1', '2']
            ]
        ];
        $this->post('/phones/addTransactionsModal', $data);
        $this->assertResponseOk();
    }

    public function testTime() {
        $date = new Time("08/11/2018 10:08 PM", "Europe/Rome");
        debug($date);
        $date = $date->timezone('UTC');

        debug($date->format("H:m:s"));
    }

    public function testAssociation() {
        $data = [
            'phone_id' => '1',
            'date' => '08/11/2018 7:58 PM',
            'id' => '1',
            'phones' => [
                [ 'id' => '1',
                    '_joinData' => []
                ]
            ]
        ];
//                $customer = TableRegistry::get('Customers')->find('all')
//            ->where(['Customers.id' => 1])
//            ->contain(['Phones'])
//            ->first();

        $customer = TableRegistry::get('Customers')->newEntity($data,
            ['associated' => 'Phones._joinData']);
//        $phone = TableRegistry::get('Phones')->find('all')
//            ->where(['id' => 1])
//            ->contain(['Customers'])
//            ->first();

            $customer->phones[0]->_joinData->date = new Time("2018-02-02 00:00:00");
//        debug($customer->phones[0]);
        $customer = TableRegistry::get('Customers')->save($customer);
//        $customer = TableRegistry::get('Customers')->find('all')
//            ->where(['Customers.id' => 1])
//            ->contain(['Phones'])
//            ->first();
        debug($customer->phones[0]);
//        debug($customer);
//        debug($customer);
    }
    public function testAvailablePhoens() {
        $phonesTable = TableRegistry::get('phones');

        $array= [];
        $phones = $phonesTable->find()->enableAutoFields(true)->all();
        foreach ($phones as $phone)
            if ($phone->is_phone_available)
                $array[] = $phone->id;

        $phones = $phonesTable->find()
            ->where(['Phones.id IN' => $array])->enableAutoFields(true);

        debug($phones->all());
        debug($array);
//        debug($phonesReturn->all());
    }
}
