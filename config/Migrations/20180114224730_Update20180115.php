<?php
use Migrations\AbstractMigration;

class Update20180115 extends AbstractMigration
{

    public function up()
    {

        $this->table('users')
            ->addColumn('user_type_id', 'integer', [
                'after' => 'facility_id',
                'default' => null,
                'length' => 11,
                'null' => true,
            ])
            ->addIndex(
                [
                    'user_type_id',
                ],
                [
                    'name' => 'user_type_id',
                ]
            )
            ->update();
    }

    public function down()
    {

        $this->table('users')
            ->removeIndexByName('user_type_id')
            ->update();

        $this->table('users')
            ->removeColumn('user_type_id')
            ->update();
    }
}

