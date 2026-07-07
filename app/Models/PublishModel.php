<?php

namespace App\Models;

use CodeIgniter\Model;

class PublishModel extends Model
{
    protected $table         = 'publish';
    protected $primaryKey    = 'id';
    protected $allowedFields = [
        'first_name',
        'last_name',
        'email',
        'telephone',
        'company_name',
        'zip_code',
        'user_id',
        'ip_address',
        'user_agent',
        'email_sent',
    ];
    protected $useTimestamps = true;
}
