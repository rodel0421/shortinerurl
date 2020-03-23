<?php
use Migrations\AbstractMigration;

class Update20171214 extends AbstractMigration
{

    public function up()
    {

        $this->table('departments_leaders', ['id' => false, 'primary_key' => ['department_id', 'user_id']])
            ->addColumn('department_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('user_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->create();
    }

    public function down()
    {

        $this->dropTable('departments_leaders');
    }
}

