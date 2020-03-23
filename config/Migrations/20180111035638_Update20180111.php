<?php
use Migrations\AbstractMigration;

class Update20180111 extends AbstractMigration
{

    public function up()
    {

        $this->table('equipment_reservations')
            ->addColumn('returned', 'boolean', [
                'after' => 'approved',
                'default' => '0',
                'length' => null,
                'null' => false,
            ])
            ->addIndex(
                [
                    'returned',
                ],
                [
                    'name' => 'returned',
                ]
            )
            ->update();
    }

    public function down()
    {

        $this->table('equipment_reservations')
            ->removeIndexByName('returned')
            ->update();

        $this->table('equipment_reservations')
            ->removeColumn('returned')
            ->update();
    }
}

