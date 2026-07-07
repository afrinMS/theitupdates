<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterWhitepaperTrackingFields extends Migration
{
    public function up()
    {
        if ($this->db->tableExists('books')) {
            $booksFields = [];

            if (! $this->db->fieldExists('ip_address', 'books')) {
                $booksFields['ip_address'] = [
                    'type'       => 'VARCHAR',
                    'constraint' => 45,
                    'null'       => true,
                    'after'      => 'username',
                ];
            }

            if (! $this->db->fieldExists('user_agent', 'books')) {
                $booksFields['user_agent'] = [
                    'type'       => 'VARCHAR',
                    'constraint' => 255,
                    'null'       => true,
                    'after'      => 'ip_address',
                ];
            }

            if ($booksFields !== []) {
                $this->forge->addColumn('books', $booksFields);
            }

            if ($this->db->fieldExists('date', 'books')) {
                $this->forge->modifyColumn('books', [
                    'date' => [
                        'type' => 'DATETIME',
                        'null' => true,
                    ],
                ]);
            }
        }

        if ($this->db->tableExists('tbl_questions')) {
            $questionFields = [];

            if (! $this->db->fieldExists('ip_address', 'tbl_questions')) {
                $questionFields['ip_address'] = [
                    'type'       => 'VARCHAR',
                    'constraint' => 45,
                    'null'       => true,
                    'after'      => 'textbox',
                ];
            }

            if (! $this->db->fieldExists('user_agent', 'tbl_questions')) {
                $questionFields['user_agent'] = [
                    'type'       => 'VARCHAR',
                    'constraint' => 255,
                    'null'       => true,
                    'after'      => 'ip_address',
                ];
            }

            if (! $this->db->fieldExists('created_at', 'tbl_questions')) {
                $questionFields['created_at'] = [
                    'type' => 'DATETIME',
                    'null' => true,
                    'after' => 'user_agent',
                ];
            }

            if ($questionFields !== []) {
                $this->forge->addColumn('tbl_questions', $questionFields);
            }
        }

        if ($this->db->tableExists('tbl_questions_text')) {
            $textQuestionFields = [];

            if (! $this->db->fieldExists('ip_address', 'tbl_questions_text')) {
                $textQuestionFields['ip_address'] = [
                    'type'       => 'VARCHAR',
                    'constraint' => 45,
                    'null'       => true,
                    'after'      => 'Question',
                ];
            }

            if (! $this->db->fieldExists('user_agent', 'tbl_questions_text')) {
                $textQuestionFields['user_agent'] = [
                    'type'       => 'VARCHAR',
                    'constraint' => 255,
                    'null'       => true,
                    'after'      => 'ip_address',
                ];
            }

            if (! $this->db->fieldExists('created_at', 'tbl_questions_text')) {
                $textQuestionFields['created_at'] = [
                    'type' => 'DATETIME',
                    'null' => true,
                    'after' => 'user_agent',
                ];
            }

            if ($textQuestionFields !== []) {
                $this->forge->addColumn('tbl_questions_text', $textQuestionFields);
            }
        }
    }

    public function down()
    {
        if ($this->db->tableExists('books')) {
            if ($this->db->fieldExists('ip_address', 'books')) {
                $this->forge->dropColumn('books', 'ip_address');
            }

            if ($this->db->fieldExists('user_agent', 'books')) {
                $this->forge->dropColumn('books', 'user_agent');
            }

            if ($this->db->fieldExists('date', 'books')) {
                $this->forge->modifyColumn('books', [
                    'date' => [
                        'type'       => 'VARCHAR',
                        'constraint' => 30,
                        'null'       => true,
                    ],
                ]);
            }
        }

        if ($this->db->tableExists('tbl_questions')) {
            if ($this->db->fieldExists('ip_address', 'tbl_questions')) {
                $this->forge->dropColumn('tbl_questions', 'ip_address');
            }

            if ($this->db->fieldExists('user_agent', 'tbl_questions')) {
                $this->forge->dropColumn('tbl_questions', 'user_agent');
            }

            if ($this->db->fieldExists('created_at', 'tbl_questions')) {
                $this->forge->dropColumn('tbl_questions', 'created_at');
            }
        }

        if ($this->db->tableExists('tbl_questions_text')) {
            if ($this->db->fieldExists('ip_address', 'tbl_questions_text')) {
                $this->forge->dropColumn('tbl_questions_text', 'ip_address');
            }

            if ($this->db->fieldExists('user_agent', 'tbl_questions_text')) {
                $this->forge->dropColumn('tbl_questions_text', 'user_agent');
            }

            if ($this->db->fieldExists('created_at', 'tbl_questions_text')) {
                $this->forge->dropColumn('tbl_questions_text', 'created_at');
            }
        }
    }
}
