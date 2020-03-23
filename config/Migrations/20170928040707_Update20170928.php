<?php
use Migrations\AbstractMigration;

class Update20170928 extends AbstractMigration
{

    public function up()
    {

        $this->table('settings')
            ->addColumn('short', 'string', [
                'after' => 'name',
                'default' => null,
                'length' => 5,
                'null' => true,
            ])
            ->update();
    }

    public function down()
    {

        $this->table('settings')
            ->removeColumn('short')
            ->update();
    }
}

