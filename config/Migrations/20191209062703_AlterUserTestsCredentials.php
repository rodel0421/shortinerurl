<?php
use Migrations\AbstractMigration;

class AlterUserTestsCredentials extends AbstractMigration
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
        $table = $this->table('user_test_credentials');
        // $table->rename('user_test_credentials');
        $table->addColumn('date_opened', 'datetime', [
            'default'   => null,
            'null'      => true,
        ]);
        $table->save();
    }
}
