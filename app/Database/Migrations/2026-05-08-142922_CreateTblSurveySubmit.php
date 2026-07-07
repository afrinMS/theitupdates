<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTblSurveySubmit extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => false,
                'auto_increment' => true,
            ],
            'survey_id' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'Questionno' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'answers' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'emailid' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('tbl_survey_submit', true);
    }

    public function down(): void
    {
        $this->forge->dropTable('tbl_survey_submit', true);
    }
}
