<?php
use Migrations\AbstractMigration;

class CreateUserTestsCredentials extends AbstractMigration
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
        $table = $this->table('user_test_credentials')
            ->addColumn('user_test_id', 'integer')
            ->addColumn('login_id', 'string')
            ->addColumn('login_pin', 'string')
            ->create();
    }
}
