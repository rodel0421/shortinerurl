<?php
use Migrations\AbstractMigration;

class Update20180112 extends AbstractMigration
{

    public $autoId = false;

    public function up()
    {

        $this->table('user_types')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => 10,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('title', 'string', [
                'default' => null,
                'limit' => 50,
                'null' => true,
            ])
            ->addColumn('active', 'boolean', [
                'default' => true,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addIndex(
                [
                    'active',
                ]
            )
            ->addIndex(
                [
                    'title',
                ]
            )
            ->create();
    }

    public function down()
    {

        $this->dropTable('user_types');
    }
}

