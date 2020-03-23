<?php
use Migrations\AbstractMigration;

class TripCategories extends AbstractMigration
{

    public $autoId = false;

    public function up()
    {
        $this->table('configs')
            ->removeIndexByName('title')
            ->update();

        $this->table('trip_categories')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => 10,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('title', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('description', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('active', 'boolean', [
                'default' => true,
                'limit' => null,
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
            ->addIndex(
                [
                    'title',
                ],
                ['unique' => true]
            )
            ->addIndex(
                [
                    'active',
                ]
            )
            ->create();

        $this->table('user_cost_centers')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => 10,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('user_id', 'integer', [
                'default' => null,
                'limit' => 10,
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('title', 'string', [
                'default' => null,
                'limit' => 100,
                'null' => false,
            ])
            ->addColumn('code', 'string', [
                'default' => null,
                'limit' => 100,
                'null' => false,
            ])
            ->addColumn('active', 'boolean', [
                'default' => true,
                'limit' => null,
                'null' => true,
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
            ->addIndex(
                [
                    'user_id',
                ]
            )
            ->addIndex(
                [
                    'active',
                ]
            )
            ->create();

        $this->table('configs')
            ->addIndex(
                [
                    'title',
                ],
                [
                    'name' => 'title',
                ]
            )
            ->update();

        $this->table('trips')
            ->addColumn('department_id', 'integer', [
                'after' => 'booking_id',
                'default' => null,
                'length' => 10,
                'null' => true,
            ])
            ->addColumn('trip_category_id', 'integer', [
                'after' => 'department_id',
                'default' => null,
                'length' => 10,
                'null' => true,
            ])
            ->addIndex(
                [
                    'department_id',
                ],
                [
                    'name' => 'department_id',
                ]
            )
            ->addIndex(
                [
                    'trip_category_id',
                ],
                [
                    'name' => 'trip_category_id',
                ]
            )
            ->update();
    }

    public function down()
    {

        $this->table('configs')
            ->removeIndexByName('title')
            ->update();

        $this->table('configs')
            ->addIndex(
                [
                    'title',
                ],
                [
                    'name' => 'title',
                    'unique' => true,
                ]
            )
            ->update();

        $this->table('trips')
            ->removeIndexByName('department_id')
            ->removeIndexByName('trip_category_id')
            ->update();

        $this->table('trips')
            ->removeColumn('department_id')
            ->removeColumn('trip_category_id')
            ->update();

        $this->dropTable('trip_categories');

        $this->dropTable('user_cost_centers');
    }
}

