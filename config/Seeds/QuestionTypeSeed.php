<?php
use Migrations\AbstractSeed;

/**
 * Groups seed.
 */
class QuestionTypeSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'value' => 'Multiple Choice'
            ],
            [
                'value' => 'Written Answer'
            ],
            [
                'value' => 'Drag and Drop'
            ],
            [
                'value' => 'Draw Over Images'
            ],
        ];

        $table = $this->table('course_question_types');
        $table->insert($data)->save();
    }
}
