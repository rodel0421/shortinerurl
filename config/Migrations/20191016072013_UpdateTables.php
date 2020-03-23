<?php
use Migrations\AbstractMigration;

class UpdateTables extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $this->table('course_tests')
            ->addColumn('name', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
                'after' => 'course_module_id',
            ])
            ->update();

        $this->table('user_tests')
            ->removeColumn('course_test_id')
            ->addColumn('course_test_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
                'after' => 'user_id',
            ])
            ->addIndex('course_test_id')
            ->update();
    }

    public function down()
    {
        $this->table('course_tests')
            ->removeColumn('name')
            ->update();
        
        $this->table('user_tests')
        ->removeColumn('course_test_id')
        ->addColumn('course_test_id', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ])
        ->addIndex('course_test_id')
        ->update();
    }
}
