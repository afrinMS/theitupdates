<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterSurveyTrackingFields extends Migration
{
    public function up(): void
    {
        // tbl_survey
        $fields = [
            'user_id' => [
                'type'       => 'INT',
                'unsigned'   => true,
                'null'       => true,
                'default'    => null,
                'after'      => 'position',
            ],
            'ip_address' => [
                'type'       => 'VARCHAR',
                'constraint' => 45,
                'null'       => true,
                'default'    => null,
                'after'      => 'user_id',
            ],
            'user_agent' => [
                'type'       => 'VARCHAR',
                'constraint' => 512,
                'null'       => true,
                'default'    => null,
                'after'      => 'ip_address',
            ],
        ];

        if ($this->db->fieldExists('user_id', 'tbl_survey') === false) {
            $this->forge->addColumn('tbl_survey', $fields);
        }

        // tbl_survey_questions
        $qFields = [
            'user_id' => [
                'type'       => 'INT',
                'unsigned'   => true,
                'null'       => true,
                'default'    => null,
                'after'      => 'sort_order',
            ],
            'ip_address' => [
                'type'       => 'VARCHAR',
                'constraint' => 45,
                'null'       => true,
                'default'    => null,
                'after'      => 'user_id',
            ],
            'user_agent' => [
                'type'       => 'VARCHAR',
                'constraint' => 512,
                'null'       => true,
                'default'    => null,
                'after'      => 'ip_address',
            ],
        ];

        if ($this->db->fieldExists('user_id', 'tbl_survey_questions') === false) {
            $this->forge->addColumn('tbl_survey_questions', $qFields);
        }
    }

    public function down(): void
    {
        if ($this->db->fieldExists('user_id', 'tbl_survey')) {
            $this->forge->dropColumn('tbl_survey', ['user_id', 'ip_address', 'user_agent']);
        }

        if ($this->db->fieldExists('user_id', 'tbl_survey_questions')) {
            $this->forge->dropColumn('tbl_survey_questions', ['user_id', 'ip_address', 'user_agent']);
        }
    }
}
