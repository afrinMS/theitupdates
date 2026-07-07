<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTblQuestionsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'Qid'        => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
                'comment'        => 'Question ID',
            ],
            'Sid'        => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
                'comment'    => 'Survey ID of tbl_survey',
            ],
            'book_id'    => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
            ],
            'user_id'    => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
            ],
            'Question'   => [
                'type'   => 'LONGTEXT',
                'null'   => false,
                'comment' => 'Question',
            ],
            'Option1'    => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
                'comment'    => 'Option1',
            ],
            'Option2'    => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
                'comment'    => 'Option2',
            ],
            'Option3'    => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
                'comment'    => 'Option3',
            ],
            'Option4'    => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
                'comment'    => 'Option4',
            ],
            'Option5'    => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
                'comment'    => 'Option5',
            ],
            'Option6'    => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
                'comment'    => 'Option6',
            ],
            'textbox'    => [
                'type'   => 'MEDIUMTEXT',
                'null'   => true,
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
        $this->forge->createTable('tbl_questions');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_questions');
    }
}
