<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['category_name' => 'IT', 'user_id' => 1, 'date' => date('Y-m-d')],
            ['category_name' => 'Marketing', 'user_id' => 1, 'date' => date('Y-m-d')],
            ['category_name' => 'Sales', 'user_id' => 1, 'date' => date('Y-m-d')],
            ['category_name' => 'HR', 'user_id' => 1, 'date' => date('Y-m-d')],
            ['category_name' => 'Operations', 'user_id' => 1, 'date' => date('Y-m-d')],
            ['category_name' => 'Finance', 'user_id' => 1, 'date' => date('Y-m-d')],
            ['category_name' => 'Current Media', 'user_id' => 1, 'date' => date('Y-m-d')],
        ];

        // Using Query Builder
        $this->db->table('categories')->insertBatch($data);
    }
}
