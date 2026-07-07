<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterAdminsAddProfileFields extends Migration
{
    public function up(): void
    {
        $fields = [];

        if (! $this->db->fieldExists('phone', 'admins')) {
            $fields['phone'] = [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
                'after'      => 'email',
            ];
        }

        if (! $this->db->fieldExists('company', 'admins')) {
            $fields['company'] = [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'after'      => $this->db->fieldExists('phone', 'admins') ? 'phone' : 'email',
            ];
        }

        if ($fields !== []) {
            $this->forge->addColumn('admins', $fields);
        }
    }

    public function down(): void
    {
        if ($this->db->fieldExists('phone', 'admins')) {
            $this->forge->dropColumn('admins', 'phone');
        }

        if ($this->db->fieldExists('company', 'admins')) {
            $this->forge->dropColumn('admins', 'company');
        }
    }
}
