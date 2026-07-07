<?php

namespace App\Models;

use CodeIgniter\Model;

class SurveyLanderModel extends Model
{
    protected $table      = 'tbl_survey';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'survey_name',
        'button_value',
        'file',
        'file_mime',
        'file_size',
        'img_title',
        'img_desc',
        'img_path',
        'privacy',
        'position',
        'user_id',
        'ip_address',
        'user_agent',
    ];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
