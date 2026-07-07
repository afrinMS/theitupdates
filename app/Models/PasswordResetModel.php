<?php

namespace App\Models;

use CodeIgniter\Model;

class PasswordResetModel extends Model
{
    protected $table = 'password_resets';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['user_id', 'token', 'created_at', 'expires_at'];
    protected $useTimestamps = false;

    /**
     * Create a reset token for a user
     */
    public function createResetToken($userId)
    {
        // Generate a unique reset token
        $token = bin2hex(random_bytes(32));
        
        // Delete any existing tokens for this user
        $this->where('user_id', $userId)->delete();
        
        // Create new token (expires in 1 hour)
        $data = [
            'user_id'    => $userId,
            'token'      => $token,
            'created_at' => date('Y-m-d H:i:s'),
            'expires_at' => date('Y-m-d H:i:s', strtotime('+1 hour')),
        ];
        
        $this->insert($data);
        
        return $token;
    }

    /**
     * Get user and validate reset token
     */
    public function validateResetToken($token)
    {
        $reset = $this->where('token', $token)
                      ->where('expires_at >', date('Y-m-d H:i:s'))
                      ->first();
        
        return $reset;
    }

    /**
     * Delete reset token
     */
    public function deleteResetToken($token)
    {
        return $this->where('token', $token)->delete();
    }

    /**
     * Delete all tokens for a user
     */
    public function deleteUserTokens($userId)
    {
        return $this->where('user_id', $userId)->delete();
    }
}
