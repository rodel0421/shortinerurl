<?php
use Migrations\AbstractMigration;

class ModuleClass extends AbstractMigration
{

    public function up()
    {
        

        $this->table('course_modules')
            ->addColumn('register_class_id', 'integer', [
                'after' => 'description',
                'default' => null,
                'length' => 10,
                'null' => true,
            ])
            ->addIndex(
                [
                    'register_class_id',
                ],
                [
                    'name' => 'register_class_id',
                ]
            )
            ->update();

    }

    public function down()
    {

        $this->table('course_modules')
            ->removeColumn('register_class_id')
            ->update();

    }
}

