<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDncTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'first_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'last_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'company_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
            ],
            'job_title' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'country' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'communication_opt_in' => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
                'default'    => 'No',
            ],
            'created_at' => [
                'type'       => 'DATETIME',
                'null'       => false,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('email');
        $this->forge->createTable('dnc');
    }

    public function down()
    {
        $this->forge->dropTable('dnc');
    }
}
