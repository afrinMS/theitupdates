<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterLoginAttemptFields extends Migration
{
    public function up(): void
    {
        // Add to admins table
        if ($this->db->tableExists('admins')) {
            $this->forge->addColumn('admins', [
                'login_attempts' => [
                    'type'       => 'TINYINT',
                    'constraint' => 3,
                    'unsigned'   => true,
                    'default'    => 0,
                    'after'      => 'password',
                ],
                'locked_until' => [
                    'type'    => 'DATETIME',
                    'null'    => true,
                    'default' => null,
                    'after'   => 'login_attempts',
                ],
            ]);
        }

        // Add to users table
        if ($this->db->tableExists('users')) {
            $this->forge->addColumn('users', [
                'login_attempts' => [
                    'type'       => 'TINYINT',
                    'constraint' => 3,
                    'unsigned'   => true,
                    'default'    => 0,
                    'after'      => 'password',
                ],
                'locked_until' => [
                    'type'    => 'DATETIME',
                    'null'    => true,
                    'default' => null,
                    'after'   => 'login_attempts',
                ],
            ]);
        }
    }

    public function down(): void
    {
        if ($this->db->tableExists('admins')) {
            $this->forge->dropColumn('admins', ['login_attempts', 'locked_until']);
        }

        if ($this->db->tableExists('users')) {
            $this->forge->dropColumn('users', ['login_attempts', 'locked_until']);
        }
    }
}
