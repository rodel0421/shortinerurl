<?php
use Migrations\AbstractMigration;

class Update201712142 extends AbstractMigration
{

    public function up()
    {

        $this->table('dashboard_items')
            ->addColumn('title', 'string', [
                'after' => 'order',
                'default' => null,
                'length' => 100,
                'null' => true,
            ])
            ->addColumn('filter_type', 'string', [
                'after' => 'title',
                'default' => null,
                'length' => 50,
                'null' => true,
            ])
            ->addColumn('filter_value', 'integer', [
                'after' => 'filter_type',
                'default' => null,
                'length' => 11,
                'null' => true,
            ])
            ->update();
    }

    public function down()
    {

        $this->table('dashboard_items')
            ->removeColumn('title')
            ->removeColumn('filter_type')
            ->removeColumn('filter_value')
            ->update();
    }
}

