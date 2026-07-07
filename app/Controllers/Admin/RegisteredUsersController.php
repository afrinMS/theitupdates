<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class RegisteredUsersController extends BaseController
{
    public function list()
    {
        if (! $this->request->isAJAX()) {
            return $this->response->setStatusCode(403)->setJSON(['success' => false]);
        }

        $model = new UserModel();
        $page = max(1, (int) ($this->request->getGet('page') ?? 1));
        $perPageInput = (int) ($this->request->getGet('per_page') ?? 10);
        $perPage = in_array($perPageInput, [10, 25, 50], true) ? $perPageInput : 10;
        $sortField = (string) ($this->request->getGet('sort_field') ?? 'created_at');
        $sortDir = strtolower((string) ($this->request->getGet('sort_dir') ?? 'desc')) === 'asc' ? 'asc' : 'desc';
        $search = trim((string) ($this->request->getGet('search') ?? ''));

        $allowedSortFields = ['name', 'email', 'job_title', 'phone_number', 'company', 'optin', 'created_at', 'ip_address'];
        if (! in_array($sortField, $allowedSortFields, true)) {
            $sortField = 'created_at';
        }

        $builder = $model->select('id, name, email, job_title, phone_number, company, optin, created_at, ip_address');

        if ($search !== '') {
            $builder->groupStart()
                ->like('name', $search)
                ->orLike('email', $search)
                ->orLike('job_title', $search)
                ->orLike('phone_number', $search)
                ->orLike('company', $search)
                ->orLike('ip_address', $search)
                ->groupEnd();
        }

        $total = (clone $builder)->countAllResults();
        $items = $builder->orderBy($sortField, $sortDir)->paginate($perPage, 'default', $page);

        return $this->response->setJSON([
            'success' => true,
            'data' => [
                'items' => $items,
                'pagination' => [
                    'page' => $page,
                    'per_page' => $perPage,
                    'total' => $total,
                    'last_page' => $model->pager->getPageCount('default'),
                ],
            ],
            'csrf' => csrf_hash(),
        ]);
    }
}
