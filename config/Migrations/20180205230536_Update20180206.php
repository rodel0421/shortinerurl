<?php
use Migrations\AbstractMigration;

class Update20180206 extends AbstractMigration
{

    public function up()
    {

        $this->table('users')
            ->addColumn('complete', 'boolean', [
                'after' => 'account_verified',
                'default' => '0',
                'length' => null,
                'null' => false,
            ])
            ->addIndex(
                [
                    'complete',
                ],
                [
                    'name' => 'complete',
                ]
            )
            ->update();
    }

    public function down()
    {

        $this->table('users')
            ->removeIndexByName('complete')
            ->update();

        $this->table('users')
            ->removeColumn('complete')
            ->update();
    }
}

