<?php
use Migrations\AbstractMigration;

class AlterUserAnswers extends AbstractMigration
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
        $table->addColumn('answer_content', 'string', [
            'default' => '',
            'null' => true
        ]);
        $table->update();
    }
}
