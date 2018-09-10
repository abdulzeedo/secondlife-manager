<?php
use Migrations\AbstractMigration;

class AddDeleteColumns extends AbstractMigration
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
        $table->addColumn('deleted', 'datetime')
            ->update();

        $table = $this->table('transactions');
        $table->addColumn('deleted', 'datetime')
            ->update();

        $table = $this->table('repairs');
        $table->addColumn('deleted', 'datetime')
            ->update();
    }
}
