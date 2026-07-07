<?php

namespace App\Models;

use CodeIgniter\Model;

class DncModel extends Model
{
    protected $table      = 'dnc';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields = ['first_name', 'last_name', 'company_name', 'email', 'job_title', 'country', 'communication_opt_in', 'ip_address', 'user_agent'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = '';

    protected $validationRules = [
        'first_name'           => 'required|string|max_length[100]',
        'last_name'            => 'required|string|max_length[100]',
        'company_name'         => 'required|string|max_length[100]',
        'email'                => 'required|valid_email|max_length[150]',
        'job_title'            => 'required|string|max_length[100]',
        'country'              => 'required|string|max_length[100]',
        'communication_opt_in' => 'required|in_list[Yes,No]',
    ];

    protected $validationMessages = [
        'first_name' => [
            'required' => 'First name is required.',
        ],
        'last_name' => [
            'required' => 'Last name is required.',
        ],
        'company_name' => [
            'required' => 'Company name is required.',
        ],
        'email' => [
            'required' => 'Email is required.',
            'valid_email' => 'Please enter a valid email address.',
        ],
        'job_title' => [
            'required' => 'Job title is required.',
        ],
        'country' => [
            'required' => 'Country is required.',
        ],
        'communication_opt_in' => [
            'required' => 'Please select Yes or No for communication preferences.',
        ],
    ];

    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    public function getDncUsers()
    {
        return $this->findAll();
    }

    public function checkEmailExists($email)
    {
        return $this->where('email', $email)->first();
    }
}
