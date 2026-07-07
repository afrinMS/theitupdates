<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $adminModel = new \App\Models\AdminModel();

        $adminModel->insert([
            'name'     => 'Admin',
            'email'    => 'admin@theitupdates.com',
            'password' => 'Admin@7656!#4',
        ]);
    }
}
