<?php
use Migrations\AbstractMigration;

class QuestionsTableUpdate extends AbstractMigration
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
        $this->table('course_questions')
            ->addColumn('img', 'string', [
                'default'   => null,
                'limit'     => 255,
                'null'      => false,
                'after'     => 'course_question_type_id'
            ])
            ->update();
    }
}
