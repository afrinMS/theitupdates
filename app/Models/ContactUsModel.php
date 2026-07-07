<?php

namespace App\Models;

use CodeIgniter\Model;

class ContactUsModel extends Model
{
    protected $table         = 'contact_us';
    protected $primaryKey    = 'id';
    protected $allowedFields = [
        'name',
        'email',
        'company',
        'message',
        'user_id',
        'ip_address',
        'user_agent',
        'email_sent',
    ];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}