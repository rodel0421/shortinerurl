<?php
use Migrations\AbstractMigration;

class Update20171013 extends AbstractMigration
{

    public function up()
    {

        $this->table('users')
            ->addColumn('disabled', 'boolean', [
                'after' => 'active',
                'default' => '0',
                'length' => null,
                'null' => false,
            ])
            ->addColumn('send_alerts', 'boolean', [
                'after' => 'disabled',
                'default' => '1',
                'length' => null,
                'null' => false,
            ])
            ->addIndex(
                [
                    'disabled',
                ],
                [
                    'name' => 'disabled',
                ]
            )
            ->addIndex(
                [
                    'send_alerts',
                ],
                [
                    'name' => 'send_alerts',
                ]
            )
            ->update();
    }

    public function down()
    {

        $this->table('users')
            ->removeIndexByName('disabled')
            ->removeIndexByName('send_alerts')
            ->update();

        $this->table('users')
            ->removeColumn('disabled')
            ->removeColumn('send_alerts')
            ->update();
    }
}

