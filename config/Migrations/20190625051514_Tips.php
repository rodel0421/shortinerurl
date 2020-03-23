<?php
use Migrations\AbstractMigration;

class Tips extends AbstractMigration
{

    public function up()
    {

        $this->table('equipment')
            ->addColumn('hire_rate', 'decimal', [
                'after' => 'for_hire',
                'default' => null,
                'null' => true,
                'precision' => 10,
                'scale' => 2,
            ])
            ->update();
    }

    public function down()
    {

        $this->table('equipment')
            ->removeColumn('hire_rate')
            ->update();
    }
}

