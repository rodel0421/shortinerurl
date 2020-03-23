<?php
use Migrations\AbstractMigration;

class Update20170921 extends AbstractMigration
{

    public function up()
    {

        $this->table('equipment_types')
            ->addColumn('hourly_booking', 'boolean', [
                'after' => 'user_equipment',
                'default' => '0',
                'length' => null,
                'null' => false,
            ])
            ->update();
    }

    public function down()
    {

        $this->table('equipment_types')
            ->removeColumn('hourly_booking')
            ->update();
    }
}

