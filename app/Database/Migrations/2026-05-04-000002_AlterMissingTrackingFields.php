<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterMissingTrackingFields extends Migration
{
    /**
     * Tables that need both ip_address + user_agent added.
     */
    private array $bothMissing = ['dnc', 'downloaded', 'partnering'];

    public function up(): void
    {
        // Add ip_address + user_agent to dnc, downloaded, partnering
        foreach ($this->bothMissing as $table) {
            if (! $this->db->tableExists($table)) {
                continue;
            }

            $columns = [];

            if (! $this->db->fieldExists('ip_address', $table)) {
                $columns['ip_address'] = [
                    'type'       => 'VARCHAR',
                    'constraint' => 45,
                    'null'       => true,
                ];
            }

            if (! $this->db->fieldExists('user_agent', $table)) {
                $columns['user_agent'] = [
                    'type'       => 'VARCHAR',
                    'constraint' => 255,
                    'null'       => true,
                ];
            }

            if ($columns !== []) {
                $this->forge->addColumn($table, $columns);
            }
        }

        // users already has ip_address — only add user_agent
        if ($this->db->tableExists('users') && ! $this->db->fieldExists('user_agent', 'users')) {
            $this->forge->addColumn('users', [
                'user_agent' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 255,
                    'null'       => true,
                    'after'      => 'ip_address',
                ],
            ]);
        }
    }

    public function down(): void
    {
        foreach ($this->bothMissing as $table) {
            if (! $this->db->tableExists($table)) {
                continue;
            }

            foreach (['ip_address', 'user_agent'] as $column) {
                if ($this->db->fieldExists($column, $table)) {
                    $this->forge->dropColumn($table, $column);
                }
            }
        }

        if ($this->db->tableExists('users') && $this->db->fieldExists('user_agent', 'users')) {
            $this->forge->dropColumn('users', 'user_agent');
        }
    }
}
