<?php

namespace App\Models;

use CodeIgniter\Model;

class DirectUploadModel extends Model
{
    protected $table            = 'tbl_uploads';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'user_id',
        'file',
        'type',
        'size',
        'img_title',
        'img_desc',
        'img_path',
        'CampaignId',
        'google',
        'ip_address',
        'user_agent',
        'date',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    protected $useTimestamps = false;
}
