<?php
use Migrations\AbstractMigration;

class Createdatabase extends AbstractMigration
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
        $this->table('machine_types', [
            'collation' => 'utf8mb4_unicode_ci'
        ])
        ->addColumn('description', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ])->addColumn('icon', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ])->create();

        $this->table('courses', [
            'collation' => 'utf8mb4_unicode_ci'
        ])
        ->addColumn('name', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ])->addColumn('code', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ])
        ->addColumn('description', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ])
        ->create();
            
        $this->table('modules', [
            'collation' => 'utf8mb4_unicode_ci'
        ])
        ->addColumn('courses_id', 'integer', [
            'default' => null,
            'limit' => 10,
            'null' => false,
            'signed' => false,
        ])
        ->addColumn('machine_types_id', 'integer', [
            'default' => null,
            'limit' => 10,
            'null' => false,
            'signed' => false,
        ])
        ->addColumn('resources_id', 'integer', [
            'default' => null,
            'limit' => 10,
            'null' => false,
            'signed' => false,
        ])
        ->addColumn('test_id', 'integer', [
            'default' => null,
            'limit' => 10,
            'null' => false,
            'signed' => false,
        ])
        
        ->addColumn('full_name', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ])

        ->addIndex(
            [
                'courses_id',
            ]
        )
        ->addIndex(
            [
                'machine_types_id',
            ]
        )
        ->addIndex(
            [
                'resources_id',
            ]
        )
        ->addIndex(
            [
                'test_id',
            ]
        )
        ->create();
            
        $this->table('enrolled_users', [
            'collation' => 'utf8mb4_unicode_ci'
        ])
        ->addColumn('user_id', 'integer', [
            'default' => null,
            'limit' => 10,
            'null' => false,
            'signed' => false,
        ])
        ->addColumn('course_id', 'integer', [
            'default' => null,
            'limit' => 10,
            'null' => false,
            'signed' => false,
        ])
        ->addColumn('date_start', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ])->addColumn('date_complete', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ])
        ->addColumn('status', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ])
        ->addIndex(
            [
                'user_id',
            ]
        )
        ->addIndex(
            [
                'course_id',
            ]
        )
        ->create();
                    
        $this->table('enrolled_modules', [
            'collation' => 'utf8mb4_unicode_ci'
        ])
        ->addColumn('enrolled_user_id', 'integer', [
            'default' => null,
            'limit' => 10,
            'null' => false,
            'signed' => false,
        ])
        ->addColumn('module_id', 'integer', [
            'default' => null,
            'limit' => 10,
            'null' => false,
            'signed' => false,
        ])
        ->addColumn('status', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ])
        ->addIndex(
            [
                'enrolled_user_id',
            ]
        )
        ->addIndex(
            [
                'module_id',
            ]
        )
        ->create();
                    
        $this->table('test', [
            'collation' => 'utf8mb4_unicode_ci'
        ])
        ->addColumn('module_id', 'integer', [
            'default' => null,
            'limit' => 10,
            'null' => false,
            'signed' => false,
        ])
        ->addColumn('type', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ])
        ->addIndex(
            [
                'module_id',
            ]
        )
        ->create();
                    
        $this->table('questions', [
            'collation' => 'utf8mb4_unicode_ci'
        ])
        ->addColumn('title', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ])
        ->addColumn('type', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ])
        ->addColumn('answer', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ])
        ->create();
        
                    
        $this->table('user_tests', [
            'collation' => 'utf8mb4_unicode_ci'
        ])
        ->addColumn('test_id', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ])
        ->addColumn('user_id', 'integer', [
            'default' => null,
            'limit' => 10,
            'null' => false,
            'signed' => false,
        ])
        ->addColumn('status', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ])
        ->addColumn('answer', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ])
        ->addIndex(
            [
                'test_id',
            ]
        )
        ->addIndex(
            [
                'user_id',
            ]
        )
        ->create();
                            
        $this->table('user_answer', [
            'collation' => 'utf8mb4_unicode_ci'
        ])
        ->addColumn('user_id', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ])
        ->addColumn('question_id', 'integer', [
            'default' => null,
            'limit' => 10,
            'null' => false,
            'signed' => false,
        ])
        ->addColumn('answer', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ])
        ->addColumn('result', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ])
        ->addIndex(
            [
                'user_id',
            ]
        )
        ->addIndex(
            [
                'question_id',
            ]
        )
        ->create();
    }
}
