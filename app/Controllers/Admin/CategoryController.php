<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CategoryModel;
use Throwable;

class CategoryController extends BaseController
{
    public function index()
    {
        return view('Admin/categories');
    }

    public function listCategories()
    {
        if (! $this->request->isAJAX()) {
            return $this->response->setStatusCode(405)->setJSON([
                'success' => false,
                'message' => 'Method not allowed.'
            ]);
        }
        $db = db_connect();
        $page    = max(1, (int) $this->request->getGet('page'));
        $perPage = (int) $this->request->getGet('per_page');
        $search  = trim((string) $this->request->getGet('search'));
        $sortField = $this->request->getGet('sort_field') ?: 'c_id';
        $sortDir   = strtolower($this->request->getGet('sort_dir')) === 'asc' ? 'ASC' : 'DESC';
        $allowedSortFields = ['c_id', 'category_name', 'date'];
        if (!in_array($sortField, $allowedSortFields, true)) {
            $sortField = 'c_id';
        }
        if (!in_array($sortDir, ['ASC', 'DESC'], true)) {
            $sortDir = 'DESC';
        }
        if (! in_array($perPage, [10, 25, 50], true)) {
            $perPage = 10;
        }
        $offset = ($page - 1) * $perPage;
        $countBuilder = $db->table('categories');
        $listBuilder  = $db->table('categories');
        if ($search !== '') {
            $countBuilder->like('category_name', $search);
            $listBuilder->like('category_name', $search);
        }
        $total = (int) (clone $countBuilder)->countAllResults();
        $rows = $listBuilder
            ->select('c_id, category_name, date')
            ->orderBy($sortField, $sortDir)
            ->limit($perPage, $offset)
            ->get()
            ->getResultArray();
        return $this->response->setJSON([
            'success' => true,
            'data' => [
                'items' => $rows,
                'pagination' => [
                    'page'      => $page,
                    'per_page'  => $perPage,
                    'total'     => $total,
                    'last_page' => max(1, (int) ceil($total / $perPage)),
                ],
            ],
        ]);
    }

    public function createCategory()
    {
        if (! $this->request->isAJAX()) {
            return $this->response->setStatusCode(405)->setJSON([
                'success' => false,
                'message' => 'Method not allowed.'
            ]);
        }
        $rules = [
            'category_name' => 'required|min_length[2]|max_length[100]'
        ];
        if (! $this->validate($rules)) {
            return $this->response->setStatusCode(422)->setJSON([
                'success' => false,
                'errors'  => $this->validator->getErrors(),
                'csrf'    => csrf_hash(),
            ]);
        }
        $model = new CategoryModel();
        $model->insert([
            'category_name' => $this->request->getPost('category_name'),
            'user_id'       => (int) session()->get('admin_id'),
            'ip_address'    => (string) $this->request->getIPAddress(),
            'user_agent'    => mb_substr((string) $this->request->getUserAgent(), 0, 255),
            'date'          => date('Y-m-d'),
        ]);
        return $this->response->setJSON([
            'success' => true,
            'message' => 'Category added successfully.',
            'csrf'    => csrf_hash(),
        ]);
    }

    public function updateCategory($id)
    {
        if (! $this->request->isAJAX()) {
            return $this->response->setStatusCode(405)->setJSON([
                'success' => false,
                'message' => 'Method not allowed.'
            ]);
        }
        $rules = [
            'category_name' => 'required|min_length[2]|max_length[100]'
        ];
        if (! $this->validate($rules)) {
            return $this->response->setStatusCode(422)->setJSON([
                'success' => false,
                'errors'  => $this->validator->getErrors(),
                'csrf'    => csrf_hash(),
            ]);
        }
        $model = new CategoryModel();
        $model->update($id, [
            'category_name' => $this->request->getPost('category_name'),
        ]);
        return $this->response->setJSON([
            'success' => true,
            'message' => 'Category updated successfully.',
            'csrf'    => csrf_hash(),
        ]);
    }

    public function deleteCategory($id)
    {
        if (! $this->request->isAJAX()) {
            return $this->response->setStatusCode(405)->setJSON([
                'success' => false,
                'message' => 'Method not allowed.'
            ]);
        }
        $model = new CategoryModel();
        $model->delete($id);
        return $this->response->setJSON([
            'success' => true,
            'message' => 'Category deleted successfully.',
            'csrf'    => csrf_hash(),
        ]);
    }

    public function getCategory($id)
    {
        if (! $this->request->isAJAX()) {
            return $this->response->setStatusCode(405)->setJSON([
                'success' => false,
                'message' => 'Method not allowed.'
            ]);
        }
        $model = new CategoryModel();
        $cat = $model->find($id);
        if (!$cat) {
            return $this->response->setStatusCode(404)->setJSON([
                'success' => false,
                'message' => 'Category not found.'
            ]);
        }
        return $this->response->setJSON([
            'success' => true,
            'data' => $cat
        ]);
    }
}
