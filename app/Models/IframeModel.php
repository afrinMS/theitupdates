<?php

namespace App\Models;

use CodeIgniter\Model;

class IframeModel extends Model
{
    protected $table = 'iframe';
    protected $primaryKey = 'iframe_id';
    protected $allowedFields = [
        'website',
        'category',
        'iframe_url',
        'image',
        'optin',
        'user_id',
        'ip_address',
        'user_agent',
        'created_at',
        'updated_at',
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}