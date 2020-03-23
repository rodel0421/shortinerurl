<?php
use Migrations\AbstractMigration;

class QuestionsUpdate extends AbstractMigration
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
            ->removeColumn('type')
            ->addColumn('course_question_type_id', 'integer',[
                'after' => 'question',
                'default' => null,
                'limit' => 11,
                'null' => true
            ])
            ->update();
    }
}
