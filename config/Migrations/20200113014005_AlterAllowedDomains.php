<?php
use Migrations\AbstractMigration;

class AlterAllowedDomains extends AbstractMigration
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
        $table = $this->table('allowed_domains')
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
                'name',
            ]
        )
        ->addIndex(
            [
                'domain',
            ]
            );
        $table->update();
    }
}
