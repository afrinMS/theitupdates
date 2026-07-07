<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $adminModel = new \App\Models\AdminModel();

        $email = 'admin@theitupdates.com';
        $data = [
            'name'     => 'Admin',
            'email'    => $email,
            'password' => 'Admin@7656!#4',
            'company'  => 'TheITUpdates',
            'phone'    => '9874563210',
            'login_attempts' => 0,
            'locked_until'   => null,
        ];

        $existing = $adminModel->where('email', $email)->first();

        if ($existing) {
            $adminModel->update($existing['id'], $data);
            return;
        }

        $adminModel->insert($data);
    }
}
