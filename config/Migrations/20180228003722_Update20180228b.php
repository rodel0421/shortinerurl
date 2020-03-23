<?php
use Migrations\AbstractMigration;

class Update20180228b extends AbstractMigration
{

    public function up()
    {

        $this->table('booking_items')
            ->addColumn('reservation_type', 'string', [
                'after' => 'public',
                'default' => null,
                'length' => 50,
                'null' => true,
            ])
            ->addColumn('block', 'text', [
                'after' => 'reservation_type',
                'default' => null,
                'length' => null,
                'null' => true,
            ])
            ->update();

        $this->table('bookings')
            ->addColumn('supervisorid', 'integer', [
                'after' => 'supervisor',
                'default' => null,
                'length' => 10,
                'null' => true,
            ])
            ->addIndex(
                [
                    'active',
                ],
                [
                    'name' => 'active',
                ]
            )
            ->addIndex(
                [
                    'archive',
                ],
                [
                    'name' => 'archive',
                ]
            )
            ->addIndex(
                [
                    'blockout',
                ],
                [
                    'name' => 'blockout',
                ]
            )
            ->addIndex(
                [
                    'end_date',
                ],
                [
                    'name' => 'end_date',
                ]
            )
            ->addIndex(
                [
                    'start_date',
                ],
                [
                    'name' => 'start_date',
                ]
            )
            ->addIndex(
                [
                    'status',
                ],
                [
                    'name' => 'status',
                ]
            )
            ->addIndex(
                [
                    'supervisorid',
                ],
                [
                    'name' => 'supervisorid',
                ]
            )
            ->update();
    }

    public function down()
    {

        $this->table('booking_items')
            ->removeColumn('reservation_type')
            ->removeColumn('block')
            ->update();

        $this->table('bookings')
            ->removeIndexByName('active')
            ->removeIndexByName('archive')
            ->removeIndexByName('blockout')
            ->removeIndexByName('end_date')
            ->removeIndexByName('start_date')
            ->removeIndexByName('status')
            ->removeIndexByName('supervisorid')
            ->update();

        $this->table('bookings')
            ->removeColumn('supervisorid')
            ->update();
    }
}

