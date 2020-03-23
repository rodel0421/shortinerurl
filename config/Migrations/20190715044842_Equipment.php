<?php
use Migrations\AbstractMigration;

class Equipment extends AbstractMigration
{

    public function up()
    {

        $this->table('equipment')
            ->addColumn('location', 'string', [
                'after' => 'issued_to',
                'default' => null,
                'length' => 200,
                'null' => true,
            ])
            ->update();
    }

    public function down()
    {

        $this->table('equipment')
            ->removeColumn('location')
            ->update();
    }
}

