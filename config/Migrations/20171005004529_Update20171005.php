<?php
use Migrations\AbstractMigration;

class Update20171005 extends AbstractMigration
{

    public function up()
    {

        $this->table('equipment_logs')
            ->changeColumn('user_id', 'integer', [
                'default' => null,
                'limit' => 10,
                'null' => true,
            ])
            ->update();

    }

    public function down()
    {
        $this->table('equipment_logs')
            ->changeColumn('user_id', 'integer', [
                'default' => null,
                'length' => 10,
                'null' => false,
            ])
            ->update();
    }
}

