<?php
use Migrations\AbstractMigration;

class UpdateDeleteColumns extends AbstractMigration
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
        $table->changeColumn('deleted', 'datetime', ['null' => true])
            ->save();

        $table = $this->table('transactions');
        $table->changeColumn('deleted', 'datetime', ['null' => true])
            ->save();

        $table = $this->table('repairs');
        $table->changeColumn('deleted', 'datetime', ['null' => true])
            ->save();
    }
}
