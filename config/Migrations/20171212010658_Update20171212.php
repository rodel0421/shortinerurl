<?php
use Migrations\AbstractMigration;

class Update20171212 extends AbstractMigration
{

    public function up()
    {
        $this->table('appointments')
            ->addColumn('sequence', 'integer', [
                'after' => 'location',
                'default' => 0,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('active', 'boolean', [
                'after' => 'location',
                'default' => true,
                'limit' => null,
                'null' => false,
            ])
            ->addIndex(
                [
                    'active',
                ],
                [
                    'name' => 'active',
                ]
            )
            ->update();
    }

    public function down()
    {
        $this->table('appointments')
            ->removeIndexByName('active')
            ->removeColumn('active')
            ->removeColumn('sequence')
            ->update();
    }
}

