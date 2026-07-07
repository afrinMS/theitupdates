<?php

namespace App\Models;

use CodeIgniter\Model;

class SurveyQuestionsModel extends Model
{
    protected $table      = 'tbl_survey_questions';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'survey_id',
        'question',
        'question_type',
        'option1',
        'option2',
        'option3',
        'option4',
        'option5',
        'option6',
        'sort_order',
        'user_id',
        'ip_address',
        'user_agent',
    ];
    protected $useTimestamps = false;
}
