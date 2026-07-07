<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddAuditColumnsToIframe extends Migration
{
    public function up()
    {
        $existing = $this->db->getFieldNames('iframe');
        $fields   = [];

        if (! in_array('user_id', $existing)) {
            $fields['user_id'] = [
                'type'       => 'INT',
                'constraint' => 20,
                'unsigned'   => true,
                'default'    => 0,
                'after'      => 'optin',
            ];
        }

        if (! in_array('ip_address', $existing)) {
            $fields['ip_address'] = [
                'type'       => 'VARCHAR',
                'constraint' => 45,
                'null'       => true,
                'after'      => 'user_id',
            ];
        }

        if (! in_array('user_agent', $existing)) {
            $fields['user_agent'] = [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'after'      => 'ip_address',
            ];
        }

        if (! empty($fields)) {
            $this->forge->addColumn('iframe', $fields);
        }
    }

    public function down()
    {
        $this->forge->dropColumn('iframe', ['user_id', 'ip_address', 'user_agent']);
    }
}
