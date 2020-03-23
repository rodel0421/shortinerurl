<?php
use Migrations\AbstractMigration;

class Update20171124 extends AbstractMigration
{

    public function up()
    {
        $this->table('trips')
            ->addColumn('supervisorid', 'integer', [
                'after' => 'supervisor',
                'default' => null,
                'limit' => 10,
                'null' => true,
            ])
            ->update();
        
        $this->execute("update trips set `status` = 'Pending' where `status` = 'Pending Approval';");
        $this->execute("update trips set `status` = 'Requires Action' where `status` = 'Not Approved';");
        $this->execute("update trips set `status` = 'Review Complete' where `status` = 'Approved';");
    }

    public function down()
    {
        $this->table('trips')
            ->removeColumn('supervisorid')
            ->update();
    }
}

