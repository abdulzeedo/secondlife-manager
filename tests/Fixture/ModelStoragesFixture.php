<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ModelStoragesFixture
 *
 */
class ModelStoragesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'storage_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'model_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'storage_key' => ['type' => 'index', 'columns' => ['storage_id'], 'length' => []],
            'model_key' => ['type' => 'index', 'columns' => ['model_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'model_storages_ibfk_1' => ['type' => 'foreign', 'columns' => ['storage_id'], 'references' => ['storages', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'model_storages_ibfk_2' => ['type' => 'foreign', 'columns' => ['model_id'], 'references' => ['models', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'storage_id' => 1,
            'model_id' => 1,
            'created' => '2018-06-26 16:25:23',
            'modified' => '2018-06-26 16:25:23'
        ],
    ];
}
