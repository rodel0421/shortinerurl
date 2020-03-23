<?php
use Migrations\AbstractMigration;

class CourseQuestionsTable extends AbstractMigration
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
            ->addColumn('user_id', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
                'after' => 'id',
            ])
            ->addIndex('user_id')
            ->update();
    }
}
