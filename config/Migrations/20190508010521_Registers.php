<?php
use Migrations\AbstractMigration;

class Registers extends AbstractMigration
{

    public function up()
    {

        $this->table('register_templates')
            ->changeColumn('name', 'string', [
                'default' => null,
                'limit' => 150,
                'null' => false,
            ])
            ->update();

        $this->table('booking_template_forms')
            ->addColumn('required', 'boolean', [
                'after' => 'title',
                'default' => '0',
                'length' => null,
                'null' => false,
            ])
            ->addColumn('pre_sub', 'boolean', [
                'after' => 'required',
                'default' => '0',
                'length' => null,
                'null' => false,
            ])
            ->addIndex(
                [
                    'pre_sub',
                ],
                [
                    'name' => 'pre_sub',
                ]
            )
            ->update();
    }

    public function down()
    {

        $this->table('booking_template_forms')
            ->removeIndexByName('pre_sub')
            ->update();

        $this->table('booking_template_forms')
            ->removeColumn('required')
            ->removeColumn('pre_sub')
            ->update();

        $this->table('register_templates')
            ->changeColumn('name', 'string', [
                'default' => null,
                'length' => 50,
                'null' => false,
            ])
            ->update();
    }
}

