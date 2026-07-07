<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminModel;

class AdminManagementController extends BaseController
{
    private const PASSWORD_CHANGE_LIMIT = 10;
    private const PASSWORD_CHANGE_WINDOW_SECONDS = 900;

    public function get(int $id)
    {
        if (! $this->request->isAJAX()) {
            return $this->response->setStatusCode(403)->setJSON(['success' => false]);
        }

        if (! $this->isSuperAdmin()) {
            return $this->response->setStatusCode(403)->setJSON([
                'success' => false,
                'message' => 'Only Super Admin can access this section.',
                'csrf' => csrf_hash(),
            ]);
        }

        $model = new AdminModel();
        $row = $model->select('id, name, email, phone, company, created_at')->find($id);

        if (! $row) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Admin not found.',
                'csrf' => csrf_hash(),
            ]);
        }

        return $this->response->setJSON([
            'success' => true,
            'data' => $row,
            'csrf' => csrf_hash(),
        ]);
    }

    public function list()
    {
        if (! $this->request->isAJAX()) {
            return $this->response->setStatusCode(403)->setJSON(['success' => false]);
        }

        if (! $this->isSuperAdmin()) {
            return $this->response->setStatusCode(403)->setJSON([
                'success' => false,
                'message' => 'Only Super Admin can access this section.',
                'csrf' => csrf_hash(),
            ]);
        }

        $model = new AdminModel();
        $page = max(1, (int) ($this->request->getGet('page') ?? 1));
        $perPageInput = (int) ($this->request->getGet('per_page') ?? 10);
        $perPage = in_array($perPageInput, [10, 25, 50], true) ? $perPageInput : 10;

        $sortField = (string) ($this->request->getGet('sort_field') ?? 'id');
        $sortDir = strtolower((string) ($this->request->getGet('sort_dir') ?? 'desc')) === 'asc' ? 'asc' : 'desc';
        $search = trim((string) ($this->request->getGet('search') ?? ''));

        $allowedSortFields = ['id', 'name', 'email', 'phone', 'company', 'created_at'];
        if (! in_array($sortField, $allowedSortFields, true)) {
            $sortField = 'id';
        }

        $builder = $model->select('id, name, email, phone, company, created_at');

        if ($search !== '') {
            $builder->groupStart()
                ->like('name', $search)
                ->orLike('email', $search)
                ->orLike('phone', $search)
                ->orLike('company', $search)
                ->groupEnd();
        }

        $total = (clone $builder)->countAllResults();
        $items = $builder->orderBy($sortField, $sortDir)
            ->paginate($perPage, 'default', $page);

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

    public function create()
    {
        if (! $this->request->isAJAX()) {
            return $this->response->setStatusCode(403)->setJSON(['success' => false]);
        }

        if (! $this->isSuperAdmin()) {
            return $this->response->setStatusCode(403)->setJSON([
                'success' => false,
                'message' => 'Only Super Admin can access this section.',
                'csrf' => csrf_hash(),
            ]);
        }

        $rules = [
            'name' => 'required|min_length[3]|max_length[255]',
            'email' => 'required|valid_email|max_length[255]|is_unique[admins.email]',
            'pass' => 'required|min_length[8]|max_length[255]|regex_match[/^(?=.*[A-Za-z])(?=.*\d).+$/]',
            'phone' => 'required|regex_match[/^[0-9]{10,15}$/]',
            'company' => 'required|min_length[2]|max_length[255]',
        ];

        $messages = [
            'pass' => [
                'regex_match' => 'Password must include at least one letter and one number.',
            ],
            'phone' => [
                'regex_match' => 'Phone must be 10 to 15 digits only.',
            ],
        ];

        if (! $this->validate($rules, $messages)) {
            return $this->response->setJSON([
                'success' => false,
                'errors' => $this->validator->getErrors(),
                'csrf' => csrf_hash(),
            ]);
        }

        $model = new AdminModel();
        $model->insert([
            'name' => $this->cleanInput((string) $this->request->getPost('name')),
            'email' => strtolower(trim((string) $this->request->getPost('email'))),
            'password' => (string) $this->request->getPost('pass'),
            'phone' => trim((string) $this->request->getPost('phone')),
            'company' => $this->cleanInput((string) $this->request->getPost('company')),
        ]);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Admin created successfully.',
            'csrf' => csrf_hash(),
        ]);
    }

    public function update(int $id)
    {
        if (! $this->request->isAJAX()) {
            return $this->response->setStatusCode(403)->setJSON(['success' => false]);
        }

        if (! $this->isSuperAdmin()) {
            return $this->response->setStatusCode(403)->setJSON([
                'success' => false,
                'message' => 'Only Super Admin can access this section.',
                'csrf' => csrf_hash(),
            ]);
        }

        $model = new AdminModel();
        $admin = $model->find($id);

        if (! $admin) {
            return $this->response->setJSON([
                'success' => false,
                'errors' => ['id' => 'Selected admin was not found.'],
                'csrf' => csrf_hash(),
            ]);
        }

        $rules = [
            'name' => 'required|min_length[3]|max_length[255]',
            'email' => 'required|valid_email|max_length[255]',
            'phone' => 'required|regex_match[/^[0-9]{10,15}$/]',
            'company' => 'required|min_length[2]|max_length[255]',
        ];

        $messages = [
            'phone' => [
                'regex_match' => 'Phone must be 10 to 15 digits only.',
            ],
        ];

        if (! $this->validate($rules, $messages)) {
            return $this->response->setJSON([
                'success' => false,
                'errors' => $this->validator->getErrors(),
                'csrf' => csrf_hash(),
            ]);
        }

        $email = strtolower(trim((string) $this->request->getPost('email')));
        $duplicate = $model->where('email', $email)->where('id !=', $id)->first();
        if ($duplicate) {
            return $this->response->setJSON([
                'success' => false,
                'errors' => ['email' => 'This email is already in use.'],
                'csrf' => csrf_hash(),
            ]);
        }

        $model->update($id, [
            'name' => $this->cleanInput((string) $this->request->getPost('name')),
            'email' => $email,
            'phone' => trim((string) $this->request->getPost('phone')),
            'company' => $this->cleanInput((string) $this->request->getPost('company')),
        ]);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Admin updated successfully.',
            'csrf' => csrf_hash(),
        ]);
    }

    public function changePassword()
    {
        if (! $this->request->isAJAX()) {
            return $this->response->setStatusCode(403)->setJSON(['success' => false]);
        }

        if (! $this->isSuperAdmin()) {
            return $this->response->setStatusCode(403)->setJSON([
                'success' => false,
                'message' => 'Only Super Admin can access this section.',
                'csrf' => csrf_hash(),
            ]);
        }

        if ($this->isPasswordRateLimited()) {
            return $this->response->setStatusCode(429)->setJSON([
                'success' => false,
                'errors' => [
                    'password' => 'Too many password changes. Please wait 15 minutes and try again.',
                ],
                'csrf' => csrf_hash(),
            ]);
        }

        $rules = [
            'id' => 'required|integer',
            'password' => 'required|min_length[8]|max_length[255]|regex_match[/^(?=.*[A-Za-z])(?=.*\d).+$/]',
        ];

        $messages = [
            'password' => [
                'regex_match' => 'Password must include at least one letter and one number.',
            ],
        ];

        if (! $this->validate($rules, $messages)) {
            return $this->response->setJSON([
                'success' => false,
                'errors' => $this->validator->getErrors(),
                'csrf' => csrf_hash(),
            ]);
        }

        $adminId = (int) $this->request->getPost('id');
        $model = new AdminModel();
        $admin = $model->find($adminId);

        if (! $admin) {
            return $this->response->setJSON([
                'success' => false,
                'errors' => ['id' => 'Selected admin was not found.'],
                'csrf' => csrf_hash(),
            ]);
        }

        $model->update($adminId, [
            'password' => (string) $this->request->getPost('password'),
        ]);

        $this->recordPasswordChangeAttempt();

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Password changed successfully.',
            'csrf' => csrf_hash(),
        ]);
    }

    public function delete(int $id)
    {
        if (! $this->request->isAJAX()) {
            return $this->response->setStatusCode(403)->setJSON(['success' => false]);
        }

        if (! $this->isSuperAdmin()) {
            return $this->response->setStatusCode(403)->setJSON([
                'success' => false,
                'message' => 'Only Super Admin can access this section.',
                'csrf'    => csrf_hash(),
            ]);
        }

        if ($id === 1) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'The Super Admin account cannot be deleted.',
                'csrf'    => csrf_hash(),
            ]);
        }

        $model = new AdminModel();
        $admin = $model->find($id);

        if (! $admin) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Admin not found.',
                'csrf'    => csrf_hash(),
            ]);
        }

        $model->delete($id);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Admin deleted successfully.',
            'csrf'    => csrf_hash(),
        ]);
    }

    private function cleanInput(string $value): string
    {
        return htmlspecialchars(strip_tags(trim($value)), ENT_QUOTES, 'UTF-8');
    }

    private function isSuperAdmin(): bool
    {
        return (int) (session()->get('admin_id') ?? 0) === 1;
    }

    private function passwordRateLimitKey(): string
    {
        $actorId = (int) (session()->get('admin_id') ?? 0);
        $ip = preg_replace('/[{}()\\/\\\\@:]+/', '_', (string) $this->request->getIPAddress());
        return 'admin_pw_change_' . $actorId . '_' . $ip;
    }

    private function isPasswordRateLimited(): bool
    {
        $count = (int) cache()->get($this->passwordRateLimitKey());
        return $count >= self::PASSWORD_CHANGE_LIMIT;
    }

    private function recordPasswordChangeAttempt(): void
    {
        $key = $this->passwordRateLimitKey();
        $count = (int) cache()->get($key);
        cache()->save($key, $count + 1, self::PASSWORD_CHANGE_WINDOW_SECONDS);
    }
}
