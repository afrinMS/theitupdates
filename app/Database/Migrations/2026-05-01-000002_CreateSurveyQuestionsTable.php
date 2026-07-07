<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSurveyQuestionsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'survey_id' => [
                'type'     => 'INT',
                'unsigned' => true,
                'null'     => false,
            ],
            'question' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'question_type' => [
                'type'       => 'ENUM',
                'constraint' => ['textbox', 'options'],
                'default'    => 'options',
            ],
            'option1' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'option2' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'option3' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'option4' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'option5' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'option6' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'sort_order' => [
                'type'    => 'TINYINT',
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
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('survey_id');
        $this->forge->createTable('tbl_survey_questions');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_survey_questions');
    }
}
