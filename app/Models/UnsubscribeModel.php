<?php

namespace App\Models;

use CodeIgniter\Model;

class UnsubscribeModel extends Model
{
    protected $table            = 'unsubscribe';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;

    protected $allowedFields = [
        'email_address',
        'landing_page',
        'ip_address',
        'user_agent',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = '';

    protected $validationRules = [
        'email_address' => 'required|valid_email|max_length[190]',
        'landing_page'  => 'permit_empty|max_length[2048]',
        'ip_address'    => 'permit_empty|max_length[45]',
        'user_agent'    => 'permit_empty|max_length[500]',
    ];
}
