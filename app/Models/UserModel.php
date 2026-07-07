<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['name', 'email', 'job_title', 'phone_number', 'company', 'optin', 'ip_address', 'user_agent', 'linkedin_flag', 'password', 'login_attempts', 'locked_until'];
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
    protected $beforeInsert     = ['hashPassword'];
    protected $beforeUpdate     = ['hashPassword'];

    protected function hashPassword(array $data)
    {
        if (isset($data['data']['password']) && !empty($data['data']['password'])) {
            $password = $data['data']['password'];
            
            // Check if password is already hashed (bcrypt format: $2a$, $2b$, or $2y$)
            if (!preg_match('/^\$2[aby]\$/', $password)) {
                // Only hash if it's not already hashed
                $data['data']['password'] = password_hash($password, PASSWORD_BCRYPT);
            }
        }
        return $data;
    }
}
