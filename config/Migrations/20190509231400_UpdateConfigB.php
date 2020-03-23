<?php
use Migrations\AbstractMigration;

class UpdateConfigB extends AbstractMigration
{

    public function up()
    {

        $this->table('configs')
            ->changeColumn('id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->update();

        $this->table('configs')
            ->addColumn('facility_id', 'integer', [
                'after' => 'id',
                'default' => null,
                'length' => 11,
                'null' => true,
            ])
            ->addIndex(
                [
                    'facility_id',
                ],
                [
                    'name' => 'facility_id',
                ]
            )
            ->update();
    }

    public function down()
    {

        $this->table('configs')
            ->removeIndexByName('facility_id')
            ->update();

        $this->table('configs')
            ->changeColumn('id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'length' => 11,
                'null' => false,
            ])
            ->removeColumn('facility_id')
            ->update();
    }
}

