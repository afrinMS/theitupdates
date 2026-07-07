<?php

namespace App\Models;

use CodeIgniter\Model;

class SubscribeModel extends Model
{
    protected $table            = 'subscribe';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;

    protected $allowedFields = [
        'email',
        'user_id',
        'ip_address',
        'user_agent',
        'email_sent',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'email' => 'required|valid_email|max_length[190]',
    ];
}
