<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterLeadTablesTrackingFields extends Migration
{
    public function up()
    {
        $this->ensureTrackingColumns('contact_us');
        $this->ensureTrackingColumns('publish');
        $this->ensureTrackingColumns('subscribe');
    }

    public function down()
    {
        $this->dropTrackingColumns('contact_us');
        $this->dropTrackingColumns('publish');
        $this->dropTrackingColumns('subscribe');
    }

    private function ensureTrackingColumns(string $table): void
    {
        if (! $this->db->tableExists($table)) {
            return;
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

        if (! $this->db->fieldExists('email_sent', $table)) {
            $columns['email_sent'] = [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 0,
            ];
        }

        if (! $this->db->fieldExists('created_at', $table)) {
            $columns['created_at'] = [
                'type' => 'DATETIME',
                'null' => true,
            ];
        }

        if (! $this->db->fieldExists('updated_at', $table)) {
            $columns['updated_at'] = [
                'type' => 'DATETIME',
                'null' => true,
            ];
        }

        if ($columns !== []) {
            $this->forge->addColumn($table, $columns);
        }
    }

    private function dropTrackingColumns(string $table): void
    {
        if (! $this->db->tableExists($table)) {
            return;
        }

        foreach (['ip_address', 'user_agent', 'email_sent', 'created_at', 'updated_at'] as $column) {
            if ($this->db->fieldExists($column, $table)) {
                $this->forge->dropColumn($table, $column);
            }
        }
    }
}
