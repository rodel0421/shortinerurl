<?php
use Migrations\AbstractMigration;

class Update20171228 extends AbstractMigration
{

    public $autoId = false;

    public function up()
    {

        $this->table('trip_type_personnel')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => 10,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('trip_type_id', 'integer', [
                'default' => null,
                'limit' => 10,
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('type', 'string', [
                'default' => null,
                'limit' => 20,
                'null' => false,
            ])
            ->addColumn('title', 'string', [
                'default' => null,
                'limit' => 100,
                'null' => false,
            ])
            ->addColumn('required_form', 'string', [
                'default' => null,
                'limit' => 100,
                'null' => true,
            ])
            ->addColumn('register_template_id', 'integer', [
                'default' => null,
                'limit' => 10,
                'null' => true,
                'signed' => false,
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
                    'trip_type_id',
                ]
            )
            ->addIndex(
                [
                    'register_template_id',
                ]
            )
            ->create();

        $this->table('trip_forms')
            ->addColumn('trip_personnel_id', 'integer', [
                'after' => 'trip_id',
                'default' => null,
                'length' => 10,
                'null' => true,
            ])
            ->addIndex(
                [
                    'trip_personnel_id',
                ],
                [
                    'name' => 'trip_personnel_id',
                ]
            )
            ->update();

        $this->table('trip_personnel')
            ->addColumn('duties', 'text', [
                'after' => 'phone',
                'default' => null,
                'length' => null,
                'null' => true,
            ])
            ->addColumn('type', 'string', [
                'after' => 'duties',
                'default' => null,
                'length' => 100,
                'null' => true,
            ])
            ->update();
    }

    public function down()
    {

        $this->table('trip_forms')
            ->removeIndexByName('trip_personnel_id')
            ->update();

        $this->table('trip_forms')
            ->removeColumn('trip_personnel_id')
            ->update();

        $this->table('trip_personnel')
            ->removeColumn('duties')
            ->removeColumn('type')
            ->update();

        $this->dropTable('trip_type_personnel');
    }
}

