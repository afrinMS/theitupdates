<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCreatedAtToSurveySubmit extends Migration
{
    public function up()
    {
        $this->db->query('ALTER TABLE `tbl_survey_submit` ADD `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `user_agent`');
    }

    public function down()
    {
        $this->forge->dropColumn('tbl_survey_submit', 'created_at');
    }
}
