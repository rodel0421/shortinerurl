<?php
use Migrations\AbstractMigration;

class Update20180717 extends AbstractMigration
{

    public function up()
    {

        $this->table('register_templates')
            ->addColumn('order', 'integer', [
                'after' => 'active',
                'default' => '1',
                'length' => 10,
                'null' => true,
            ])
            ->addIndex(
                [
                    'order',
                ],
                [
                    'name' => 'order',
                ]
            )
            ->update();
        
        $this->execute("SET @rownumber = 0; update register_templates set `order` = (@rownumber:=@rownumber+1) order by name asc;");
    }

    public function down()
    {

        $this->table('register_templates')
            ->removeIndexByName('order')
            ->update();

        $this->table('register_templates')
            ->removeColumn('order')
            ->update();
    }
}

