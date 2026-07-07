<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateIframeTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'iframe_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'website' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ],
            'category' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
            ],
            'iframe_url' => [
                'type' => 'VARCHAR',
                'constraint' => 1000,
                'null' => false,
            ],
            'image' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'optin' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
            ],
            'user_id'    => [
                'type'       => 'INT',
                'constraint' => 20,
                'unsigned'   => true,
                'default'    => 0,
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
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('iframe_id', true);
        $this->forge->createTable('iframe');
    }

    public function down()
    {
        $this->forge->dropTable('iframe');
    }
}