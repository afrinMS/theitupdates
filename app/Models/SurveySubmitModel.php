<?php

namespace App\Models;

use CodeIgniter\Model;

class SurveySubmitModel extends Model
{
    protected $table         = 'tbl_survey_submit';
    protected $primaryKey    = 'id';
    protected $useAutoIncrement = true;
    protected $returnType    = 'array';

    protected $allowedFields = [
        'survey_id',
        'Questionno',
        'answers',
        'emailid',
        'ip_address',
        'user_agent',
    ];

    protected $useTimestamps = false;

    protected $validationRules = [
        'survey_id'  => 'required',
        'Questionno' => 'required',
        'answers'    => 'required',
        'emailid'    => 'required|valid_email|max_length[100]',
    ];
}
