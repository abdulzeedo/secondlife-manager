<?php
use Migrations\AbstractMigration;

class UpdateItemReturns extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
//        $table = $this->table('item_returns_types');
//        $table->addColumn('name', 'string', [
//            'default' => null,
//            'limit' => 255,
//            'null' => true,
//        ]);
//        $table->addColumn('description', 'string', [
//            'default' => null,
//            'limit' => 255,
//            'null' => true,
//        ]);
//        $table->addColumn('created', 'datetime', [
//            'default' => null,
//            'null' => false,
//        ]);
//        $table->addColumn('modified', 'datetime', [
//            'default' => null,
//            'null' => false,
//        ]);
//        $table->create();


//        $table = $this->table('item_returns');
//        $table->addColumn('customer_return_tracking', 'string', [
//            'default' => null,
//            'limit' => 255,
//            'null' => true,
//        ]);
//        $table->addColumn('customer_resent_tracking', 'string', [
//            'default' => null,
//            'limit' => 255,
//            'null' => true,
//        ]);
//        $table->addColumn('exchanged_with_item_id', 'string', [
//            'default' => null,
//            'limit' => 255,
//            'null' => true,
//        ]);
//        $table->addColumn('refund_amount', 'string', [
//            'default' => null,
//            'limit' => 255,
//            'null' => true,
//        ]);
//        $table->addColumn('item_returns_type_status_id', 'integer', [
//            'default' => null,
//            'null' => true,
//        ])->addForeignKey('item_returns_type_status_id', 'item_returns_type_status',
//            'id', ['delete'=> 'SET_NULL', 'update'=> 'NO_ACTION']);
//
//        $table->addColumn('item_returns_status_id', 'integer', [
//            'default' => null,
//            'null' => true,
//        ])
//            ->addForeignKey('item_returns_status_id', 'item_returns_status',
//                'id', ['delete'=> 'SET_NULL', 'update'=> 'NO_ACTION']);
//        $table->update();


        $table = $this->table('item_returns_type_status');
        $table->addColumn('name', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);
        $table->addColumn('description', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);
        $table->addColumn('item_returns_types_id', 'integer', [
            'default' => null,
            'null' => true,
        ])->addForeignKey('item_returns_types_id', 'item_returns_types',
            'id', ['delete'=> 'SET_NULL', 'update'=> 'NO_ACTION']);
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->create();


        $table = $this->table('item_returns_status');
        $table->addColumn('name', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);
        $table->addColumn('description', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->create();
    }
}
