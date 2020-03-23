<?php
use Migrations\AbstractMigration;

class Update20180219 extends AbstractMigration
{

    public function up()
    {

        $this->table('trip_forms')
            ->addColumn('post_trip', 'boolean', [
                'after' => 'trip_personnel_id',
                'default' => '0',
                'length' => null,
                'null' => false,
            ])
            ->update();

        $this->table('trip_types')
            ->addColumn('post_optional_forms', 'text', [
                'after' => 'optional_forms',
                'default' => null,
                'length' => null,
                'null' => true,
            ])
            ->addColumn('post_required_forms', 'text', [
                'after' => 'post_optional_forms',
                'default' => null,
                'length' => null,
                'null' => true,
            ])
            ->update();

        $this->table('trips')
            ->addColumn('post_complete', 'boolean', [
                'after' => 'archived',
                'default' => '0',
                'length' => null,
                'null' => false,
            ])
            ->update();
    }

    public function down()
    {

        $this->table('trip_forms')
            ->removeColumn('post_trip')
            ->update();

        $this->table('trip_types')
            ->removeColumn('post_optional_forms')
            ->removeColumn('post_required_forms')
            ->update();

        $this->table('trips')
            ->removeColumn('post_complete')
            ->update();
    }
}

