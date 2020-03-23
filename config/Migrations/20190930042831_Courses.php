<?php
use Migrations\AbstractMigration;

class Courses extends AbstractMigration
{

    public function up()
    {
        $this->table('alerts')
            ->removeIndexByName('controller')
            ->update();
        $this->table('equipment')
            ->removeIndexByName('title')
            ->update();
        $this->table('equipment_indexes')
            ->removeIndexByName('value')
            ->update();
        $this->table('guides')
            ->removeIndexByName('controller')
            ->update();
        $this->table('messages')
            ->removeIndexByName('title')
            ->update();
        $this->table('resources')
            ->removeIndexByName('description')
            ->update();
        $this->table('tokens')
            ->removeIndexByName('token')
            ->update();
        $this->table('user_answer')
            ->removeIndexByName('user_id')
            ->update();
        $this->table('user_tests')
            ->removeIndexByName('test_id')
            ->update();
        $this->table('users')
            ->removeIndexByName('username')
            ->update();

        $this->table('alerts')
            ->addIndex(
                [
                    'controller',
                ],
                [
                    'name' => 'controller',
                ]
            )
            ->update();

        $this->table('equipment')
            ->addIndex(
                [
                    'title',
                ],
                [
                    'name' => 'title',
                ]
            )
            ->update();

        $this->table('equipment_indexes')
            ->addIndex(
                [
                    'value',
                ],
                [
                    'name' => 'value',
                ]
            )
            ->update();

        $this->table('guides')
            ->addIndex(
                [
                    'controller',
                ],
                [
                    'name' => 'controller',
                ]
            )
            ->update();

        $this->table('messages')
            ->addIndex(
                [
                    'title',
                ],
                [
                    'name' => 'title',
                ]
            )
            ->update();

        $this->table('resources')
            ->addIndex(
                [
                    'description',
                ],
                [
                    'name' => 'description',
                ]
            )
            ->update();

        $this->table('tokens')
            ->addIndex(
                [
                    'token',
                ],
                [
                    'name' => 'token',
                ]
            )
            ->update();

        $this->table('user_answer')
            ->addIndex(
                [
                    'user_id',
                ],
                [
                    'name' => 'user_id',
                ]
            )
            ->update();

        $this->table('user_tests')
            ->addIndex(
                [
                    'test_id',
                ],
                [
                    'name' => 'test_id',
                ]
            )
            ->update();

        $this->table('users')
            ->addIndex(
                [
                    'username',
                ],
                [
                    'name' => 'username',
                ]
            )
            ->update();
    }

    public function down()
    {

        $this->table('alerts')
            ->removeIndexByName('controller')
            ->update();

        $this->table('alerts')
            ->addIndex(
                [
                    'controller',
                ],
                [
                    'name' => 'controller',
                ]
            )
            ->update();

        $this->table('equipment')
            ->removeIndexByName('title')
            ->update();

        $this->table('equipment')
            ->addIndex(
                [
                    'title',
                ],
                [
                    'name' => 'title',
                ]
            )
            ->update();

        $this->table('equipment_indexes')
            ->removeIndexByName('value')
            ->update();

        $this->table('equipment_indexes')
            ->addIndex(
                [
                    'value',
                ],
                [
                    'name' => 'value',
                ]
            )
            ->update();

        $this->table('guides')
            ->removeIndexByName('controller')
            ->update();

        $this->table('guides')
            ->addIndex(
                [
                    'controller',
                ],
                [
                    'name' => 'controller',
                ]
            )
            ->update();

        $this->table('messages')
            ->removeIndexByName('title')
            ->update();

        $this->table('messages')
            ->addIndex(
                [
                    'title',
                ],
                [
                    'name' => 'title',
                ]
            )
            ->update();

        $this->table('resources')
            ->removeIndexByName('description')
            ->update();

        $this->table('resources')
            ->addIndex(
                [
                    'description',
                ],
                [
                    'name' => 'description',
                ]
            )
            ->update();

        $this->table('tokens')
            ->removeIndexByName('token')
            ->update();

        $this->table('tokens')
            ->addIndex(
                [
                    'token',
                ],
                [
                    'name' => 'token',
                ]
            )
            ->update();

        $this->table('user_answer')
            ->removeIndexByName('user_id')
            ->update();

        $this->table('user_answer')
            ->addIndex(
                [
                    'user_id',
                ],
                [
                    'name' => 'user_id',
                ]
            )
            ->update();

        $this->table('user_tests')
            ->removeIndexByName('test_id')
            ->update();

        $this->table('user_tests')
            ->addIndex(
                [
                    'test_id',
                ],
                [
                    'name' => 'test_id',
                ]
            )
            ->update();

        $this->table('users')
            ->removeIndexByName('username')
            ->update();

        $this->table('users')
            ->addIndex(
                [
                    'username',
                ],
                [
                    'name' => 'username',
                ]
            )
            ->update();
    }
}

