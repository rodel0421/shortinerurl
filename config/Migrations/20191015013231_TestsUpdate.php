<?php
use Migrations\AbstractMigration;

class TestsUpdate extends AbstractMigration
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

        $this->table('course_question_answers')
            ->addColumn('course_question_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('course_question_choice_id', 'integer', [
                'default' => null,
                'limit' => 11,
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
            ->addIndex(['course_question_id'])
            ->create();

        $this->table('course_question_choices')
            ->addColumn('course_question_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('value', 'string', [
                'default' => null,
                'limit' => 255,
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
            ->addIndex(['course_question_id','value']) 
            ->create();        

        $this->table('course_test_types')
            ->addColumn('value', 'string', [
                'default' => null,
                'limit' => 255,
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
            ->addIndex(['id','value']) 
            ->create();  


        $this->table('course_tests')
            ->removeColumn('type')
            ->addColumn('course_test_type_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->update();

        $this->table('course_module_machine_types')
            ->addColumn('course_module_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('course_machine_type_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])   
            ->addIndex(['course_module_id','course_machine_type_id']) 
            ->create();

        $this->table('course_modules')
            ->removeColumn('course_machine_types_id')
            ->update();

        $this->table('course_question_types')
            ->addColumn('value', 'string', [
                'default' => null,
                'limit' => 255,
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
            ->addIndex(['id','value']) 
            ->create();                  
        
        $this->table('user_tests')
            ->renameColumn('test_id', 'course_test_id')
            ->addIndex(['course_test_id'])
            ->update();
        
        $this->table('user_answer')
            ->rename('user_answers')
            ->addColumn('user_test_id', 'integer', [
                'after' => 'id',
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('answer_id', 'integer', [
                'after' => 'question_id',
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->removecolumn('answer')
            ->addIndex(['user_test_id','answer_id'])
            ->update();
    }

    public function down()
    {
        $this->dropTable('course_question_answers');
        $this->dropTable('course_question_choices');
        $this->dropTable('course_test_types');
        $this->table('course_tests')
            ->removeColumn('course_test_type_id')
            ->addColumn('type', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->update();
        $this->dropTable('course_question_answers');
        $this->dropTable('course_module_machine_types');
        $this->table('course_modules')
            ->addColumn('course_machine_types_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->update();
        $this->dropTable('course_question_types');
        $this->table('user_tests')
            ->renameColumn('course_test_id', 'test_id')
            ->addIndex(['test_id'])
            ->update();

        $this->table('user_answers')
            ->rename('user_answer')
            ->removeColumn('user_test_id')
            ->removeColumn('answer_id')
            ->addColumn('answer', 'string', [
                'default' => null,
                'limit' => 222,
                'null' => false,
            ])
            ->update();            
    }
}
