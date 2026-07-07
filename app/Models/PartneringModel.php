<?php

namespace App\Models;

use CodeIgniter\Model;

class PartneringModel extends Model
{
    protected $table      = 'partnering';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'name', 'job_title', 'email', 'company_name',
        'industry', 'phone', 'country', 'message',
        'ip_address', 'user_agent',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = '';

    protected $validationRules = [
        'name'         => 'required|string|min_length[2]|max_length[150]',
        'job_title'    => 'required|string|max_length[100]',
        'email'        => 'required|valid_email|max_length[150]',
        'company_name' => 'required|string|max_length[150]',
        'industry'     => 'required|string|max_length[100]',
        'phone'        => 'permit_empty|string|max_length[30]',
        'country'      => 'required|string|max_length[100]',
        'message'      => 'permit_empty|string|max_length[2000]',
    ];

    protected $validationMessages = [
        'name' => [
            'required'   => 'Name is required.',
            'min_length' => 'Name must be at least 2 characters.',
        ],
        'job_title' => [
            'required' => 'Job title is required.',
        ],
        'email' => [
            'required'    => 'Email is required.',
            'valid_email' => 'Please enter a valid email address.',
        ],
        'company_name' => [
            'required' => 'Company name is required.',
        ],
        'industry' => [
            'required' => 'Industry is required.',
        ],
        'country' => [
            'required' => 'Country is required.',
        ],
    ];

    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    public function checkEmailExists(string $email): bool
    {
        return $this->where('email', $email)->countAllResults() > 0;
    }
}
