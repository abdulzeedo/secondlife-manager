<?php
use Migrations\AbstractMigration;

class CreatePhoneRecords extends AbstractMigration
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
        $table = $this->table('phone_records');
        $table->addColumn('user_id', 'integer', [
            'default' => null,
            'null' => true,
        ])->addForeignKey('user_id', 'users',
                'id', ['delete'=> 'SET_NULL', 'update'=> 'NO_ACTION']);
        $table->addColumn('is_used', 'integer', [
            'default' => 0,
        ]);
        $table->addColumn('item_id', 'integer', [
            'default' => null,
            'null' => true,
        ])->addForeignKey('item_id', 'phones',
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
    }
}
