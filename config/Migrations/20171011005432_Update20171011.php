<?php
use Migrations\AbstractMigration;

class Update20171011 extends AbstractMigration
{

    public function up()
    {

        $this->table('trip_logs')
            ->addColumn('active', 'boolean', [
                'after' => 'file_size',
                'default' => '1',
                'length' => null,
                'null' => false,
            ])
            ->update();
    }

    public function down()
    {

        $this->table('trip_logs')
            ->removeColumn('active')
            ->update();
    }
}

