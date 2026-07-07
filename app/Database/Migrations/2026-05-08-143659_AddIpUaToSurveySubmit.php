<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddIpUaToSurveySubmit extends Migration
{
    public function up()
    {
        $this->forge->addColumn('tbl_survey_submit', [
            'ip_address' => [
                'type'       => 'VARCHAR',
                'constraint' => 45,
                'null'       => true,
                'default'    => null,
                'after'      => 'emailid',
            ],
            'user_agent' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'default'    => null,
                'after'      => 'ip_address',
            ],
        ]);
    }

    public function down(): void
    {
        $this->forge->dropColumn('tbl_survey_submit', ['ip_address', 'user_agent']);
    }
}
