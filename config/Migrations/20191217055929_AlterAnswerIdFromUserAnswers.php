<?php
use Migrations\AbstractMigration;

class AlterAnswerIdFromUserAnswers extends AbstractMigration
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
        $table = $this->table('user_answers');
        $table->changeColumn('answer_id', 'integer', [
            'default' => 0,
            'null' => true,
        ]);        
        $table->update();
    }
}
