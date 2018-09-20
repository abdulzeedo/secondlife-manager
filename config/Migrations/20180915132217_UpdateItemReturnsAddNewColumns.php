<?php
use Migrations\AbstractMigration;

class UpdateItemReturnsAddNewColumns extends AbstractMigration
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
        $table = $this->table('item_returns');
        $table->addColumn('request_date', 'datetime', [
            'default' => null,
            'null' => true,
        ]);
        $table->update();
    }
}
