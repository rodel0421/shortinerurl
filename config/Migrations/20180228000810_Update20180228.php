<?php
use Migrations\AbstractMigration;

class Update20180228 extends AbstractMigration
{

    public function up()
    {

        $this->table('bookings')
            ->changeColumn('leader', 'string', [
                'default' => null,
                'limit' => 200,
                'null' => true,
            ])
            ->changeColumn('email', 'string', [
                'default' => null,
                'limit' => 250,
                'null' => true,
            ])
            ->update();

        $this->table('bookings')
            ->addColumn('blockout', 'boolean', [
                'after' => 'internal',
                'default' => '0',
                'length' => null,
                'null' => false,
            ])
            ->addColumn('items_ans', 'text', [
                'after' => 'key',
                'default' => null,
                'length' => null,
                'null' => true,
            ])
            ->update();

        $this->table('facilities')
            ->addColumn('bookings_max_ppl', 'integer', [
                'after' => 'bookings_email',
                'default' => null,
                'length' => 11,
                'null' => true,
            ])
            ->addColumn('bookings_calendar', 'text', [
                'after' => 'bookings_max_ppl',
                'default' => null,
                'length' => null,
                'null' => true,
            ])
            ->update();

    }

    public function down()
    {

        $this->table('bookings')
            ->changeColumn('leader', 'string', [
                'default' => null,
                'length' => 200,
                'null' => false,
            ])
            ->changeColumn('email', 'string', [
                'default' => null,
                'length' => 250,
                'null' => false,
            ])
            ->removeColumn('blockout')
            ->removeColumn('items_ans')
            ->update();

        $this->table('facilities')
            ->removeColumn('bookings_max_ppl')
            ->removeColumn('bookings_calendar')
            ->update();

    }
}

