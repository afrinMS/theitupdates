<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUnsubscribeTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true,
            ],
            'email_address' => [
                'type' => 'VARCHAR', 'constraint' => 190,
            ],
            'landing_page' => [
                'type' => 'VARCHAR', 'constraint' => 2048, 'null' => true,
            ],
            'ip_address' => [
                'type' => 'VARCHAR', 'constraint' => 45, 'null' => true,
            ],
            'user_agent' => [
                'type' => 'VARCHAR', 'constraint' => 500, 'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME', 'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('email_address');
        $this->forge->addKey('created_at');
        $this->forge->createTable('unsubscribe', true);
    }

    public function down()
    {
        $this->forge->dropTable('unsubscribe', true);
    }
}
