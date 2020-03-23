<?php
use Migrations\AbstractMigration;

class Update20171006 extends AbstractMigration
{

    public function up()
    {

        $this->table('groups')
            ->addColumn('style', 'string', [
                'after' => 'name',
                'default' => null,
                'length' => 100,
                'null' => true,
            ])
            ->update();
    }

    public function down()
    {

        $this->table('groups')
            ->removeColumn('style')
            ->update();
    }
}

