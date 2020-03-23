<?php
use Migrations\AbstractMigration;

class Update20170927 extends AbstractMigration
{

    public function up()
    {

        $this->table('equipment_types')
            ->addColumn('auto_approval', 'boolean', [
                'after' => 'hourly_booking',
                'default' => '0',
                'length' => null,
                'null' => false,
            ])
            ->update();
    }

    public function down()
    {

        $this->table('equipment_types')
            ->removeColumn('auto_approval')
            ->update();
    }
}

