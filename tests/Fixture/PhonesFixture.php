<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PhonesFixture
 *
 */
class PhonesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'imiei' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'serial_number' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'grade' => ['type' => 'string', 'length' => 50, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'status' => ['type' => 'string', 'length' => 50, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'storage_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'comments' => ['type' => 'text', 'length' => 4294967295, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null],
        'model_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'colour_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'battery_health' => ['type' => 'float', 'length' => null, 'precision' => null, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => ''],
        'sim_lock_status' => ['type' => 'string', 'length' => 50, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'battery_cycles' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'os_version' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'region_code' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'model_number' => ['type' => 'string', 'length' => 50, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'user_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'supplier_order_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'storage_key' => ['type' => 'index', 'columns' => ['storage_id'], 'length' => []],
            'model_key' => ['type' => 'index', 'columns' => ['model_id'], 'length' => []],
            'colour_key' => ['type' => 'index', 'columns' => ['colour_id'], 'length' => []],
            'user_id' => ['type' => 'index', 'columns' => ['user_id'], 'length' => []],
            'supplier_order_key' => ['type' => 'index', 'columns' => ['supplier_order_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'imiei' => ['type' => 'unique', 'columns' => ['imiei'], 'length' => []],
            'serial_number' => ['type' => 'unique', 'columns' => ['serial_number'], 'length' => []],
            'phones_ibfk_1' => ['type' => 'foreign', 'columns' => ['model_id'], 'references' => ['models', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'phones_ibfk_2' => ['type' => 'foreign', 'columns' => ['colour_id'], 'references' => ['colours', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'phones_ibfk_3' => ['type' => 'foreign', 'columns' => ['user_id'], 'references' => ['users', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'storage_key' => ['type' => 'foreign', 'columns' => ['storage_id'], 'references' => ['storages', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'supplier_order_key' => ['type' => 'foreign', 'columns' => ['supplier_order_id'], 'references' => ['supplier_orders', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Init method
     *
     * @return void
     */
    public function init()
    {
        $this->records = [
            [
                'id' => 1,
                'imiei' => '12345',
                'serial_number' => 'Lorem ipsum dolor sit amet',
                'grade' => 'Lorem ipsum dolor sit amet',
                'status' => 'Lorem ipsum dolor sit amet',
                'storage_id' => 1,
                'created' => '2018-08-01 02:14:38',
                'modified' => '2018-08-01 02:14:38',
                'comments' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'model_id' => 1,
                'colour_id' => 1,
                'battery_health' => 1,
                'sim_lock_status' => 'Lorem ipsum dolor sit amet',
                'battery_cycles' => 1,
                'os_version' => 'Lorem ipsum dolor sit amet',
                'region_code' => 'Lorem ipsum dolor sit amet',
                'model_number' => 'Lorem ipsum dolor sit amet',
                'user_id' => 1,
                'supplier_order_id' => 1
            ],
            [
                'id' => 2,
                'imiei' => '1232245',
                'serial_number' => 'Lorem22 ipsum dolor sit amet',
                'grade' => 'Lorem ipsum dolor sit amet',
                'status' => 'Lorem ipsum dolor sit amet',
                'storage_id' => 1,
                'created' => '2018-08-01 02:14:38',
                'modified' => '2018-08-01 02:14:38',
                'comments' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'model_id' => 1,
                'colour_id' => 1,
                'battery_health' => 1,
                'sim_lock_status' => 'Lorem ipsum dolor sit amet',
                'battery_cycles' => 1,
                'os_version' => 'Lorem ipsum dolor sit amet',
                'region_code' => 'Lorem ipsum dolor sit amet',
                'model_number' => 'Lorem ipsum dolor sit amet',
                'user_id' => 1,
                'supplier_order_id' => 1
            ],
        ];
        parent::init();
    }
}
