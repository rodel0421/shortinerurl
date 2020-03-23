<?php
use Migrations\AbstractSeed;

/**
 * Groups seed.
 */
class GroupsSeed extends AbstractSeed
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
                'id' => '1',
                'name' => 'Admin',
                'created' => '2013-10-21 18:24:20',
                'modified' => '2013-10-21 18:24:20',
            ],
            [
                'id' => '2',
                'name' => 'Officer / Manager',
                'created' => '2013-10-21 18:24:24',
                'modified' => '2014-05-09 21:05:37',
            ],
            [
                'id' => '3',
                'name' => 'Read Only',
                'created' => '2013-10-21 18:24:31',
                'modified' => '2014-05-09 21:06:09',
            ],
            [
                'id' => '4',
                'name' => 'Staff',
                'created' => '2013-11-03 19:47:58',
                'modified' => '2014-05-09 21:06:27',
            ],
            [
                'id' => '5',
                'name' => 'User / Operator',
                'created' => '2014-03-17 13:30:02',
                'modified' => '2014-05-09 21:06:44',
            ],
            [
                'id' => '6',
                'name' => 'Student',
                'created' => '2014-04-01 13:02:13',
                'modified' => '2014-05-09 21:07:25',
            ],
            [
                'id' => '7',
                'name' => 'Limited',
                'created' => '2014-04-09 15:25:44',
                'modified' => '2014-05-09 21:07:43',
            ],
        ];

        $table = $this->table('groups');
        $table->insert($data)->save();
    }
}
