<?php
use Migrations\AbstractMigration;

class UpdateConfig extends AbstractMigration
{

    public function up()
    {

        $this->table('configs')
            ->addColumn('title', 'string', [
                'default' => null,
                'limit' => 100,
                'null' => false,
            ])
            ->addColumn('type', 'string', [
                'default' => null,
                'limit' => 100,
                'null' => false,
            ])
            ->addColumn('data', 'text', [
                'default' => null,
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
                    'title',
                ],
                ['name' => 'title']
            )
            ->create();
    }

    public function down()
    {

        $this->dropTable('configs');
    }
}

