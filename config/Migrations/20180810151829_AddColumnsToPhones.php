<?php
use Migrations\AbstractMigration;

class AddColumnsToPhones extends AbstractMigration
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
        $table = $this->table('phones');
        $table->addColumn('icloud_status', 'string', [
            'default' => '0',
            'limit' => 50,
            'null' => false,
        ]);
        $table->addColumn('touch_id_status', 'string', [
            'default' => '0',
            'limit' => 50,
            'null' => false,
        ]);
        $table->update();
    }
}
