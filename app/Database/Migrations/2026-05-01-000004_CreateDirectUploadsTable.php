<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDirectUploadsTable extends Migration
{
    public function up(): void
    {
        if ($this->db->tableExists('tbl_uploads')) {
            return;
        }

        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type'       => 'INT',
                'constraint' => 20,
                'unsigned'   => true,
                'default'    => 0,
            ],
            'file' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'type' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'size' => [
                'type'       => 'INT',
                'unsigned'   => true,
                'default'    => 0,
            ],
            'img_title' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'img_desc' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'img_path' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'CampaignId' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
            'google' => [
                'type'       => 'VARCHAR',
                'constraint' => 10,
                'null'       => false,
            ],
            'ip_address' => [
                'type'       => 'VARCHAR',
                'constraint' => 45,
                'null'       => true,
            ],
            'user_agent' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'date' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('CampaignId');
        $this->forge->addKey('user_id');
        $this->forge->createTable('tbl_uploads');
    }

    public function down(): void
    {
        if ($this->db->tableExists('tbl_uploads')) {
            $this->forge->dropTable('tbl_uploads');
        }
    }
}
