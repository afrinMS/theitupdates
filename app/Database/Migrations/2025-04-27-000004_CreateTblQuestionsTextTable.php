<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTblQuestionsTextTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'Qid'       => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
                'comment'        => 'Question ID',
            ],
            'Sid'       => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
                'comment'    => 'Survey ID of tbl_survey',
            ],
            'book_id'   => [
                'type'       => 'INT',
                'constraint' => 10,
                'unsigned'   => true,
                'null'       => false,
            ],
            'user_id'   => [
                'type'       => 'INT',
                'constraint' => 20,
                'unsigned'   => true,
                'null'       => false,
            ],
            'Question'  => [
                'type'    => 'LONGTEXT',
                'null'    => false,
                'comment' => 'Question',
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
        ]);

        $this->forge->addKey('Qid', true);
        $this->forge->createTable('tbl_questions_text');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_questions_text');
    }
}
