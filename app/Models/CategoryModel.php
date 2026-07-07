<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'c_id';
    protected $allowedFields = ['category_name', 'user_id', 'ip_address', 'user_agent', 'date'];
    public $timestamps = false;
}
