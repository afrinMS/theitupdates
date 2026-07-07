<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\IframeModel;
use CodeIgniter\HTTP\ResponseInterface;

class IframeController extends BaseController
{
    // List all iframe entries (AJAX)
    public function list()
    {
        if (!$this->request->isAJAX()) {
            return $this->failForbidden('AJAX only');
        }
        $model = new IframeModel();
        $page = (int) $this->request->getGet('page') ?: 1;
        $perPage = (int) $this->request->getGet('per_page') ?: 10;
        $sortField = $this->request->getGet('sort_field') ?: 'iframe_id';
        $sortDir = strtolower($this->request->getGet('sort_dir')) === 'desc' ? 'desc' : 'asc';
        $search = trim($this->request->getGet('search') ?? '');

        $builder = $model;
        if ($search !== '') {
            $builder = $builder->groupStart()
                ->like('website', $search)
                ->orLike('category', $search)
                ->orLike('iframe_url', $search)
                ->groupEnd();
        }
        $total = (clone $builder)->countAllResults();
        $items = $builder->orderBy($sortField, $sortDir)
            ->paginate($perPage, 'default', $page);
        $pager = $model->pager;
        $pagination = [
            'page' => $page,
            'per_page' => $perPage,
            'total' => $total,
            'last_page' => $pager->getPageCount(),
        ];
        return $this->response->setJSON([
            'success' => true,
            'data' => [
                'items' => $items,
                'pagination' => $pagination,
            ],
        ]);
    }

    // Get single iframe entry
    public function get($id)
    {
        if (!$this->request->isAJAX()) {
            return $this->failForbidden('AJAX only');
        }
        $model = new IframeModel();
        $row = $model->find($id);
        if (!$row) {
            return $this->response->setJSON(['success' => false, 'message' => 'Not found']);
        }
        return $this->response->setJSON(['success' => true, 'data' => $row]);
    }

    // Create new iframe entry
    public function create()
    {
        if (!$this->request->isAJAX()) {
            return $this->failForbidden('AJAX only');
        }
        $validation = \Config\Services::validation();
        $rules = [
            'website' => 'required|max_length[255]',
            'category' => 'required|max_length[100]',
            'iframe_url' => 'required|valid_url|max_length[1000]',
            'optin' => 'permit_empty|in_list[0,1]',
            'image' => 'permit_empty|uploaded[image]|is_image[image]|max_size[image,2048]'
        ];
        if (! $this->validate($rules)) {
            return $this->response->setJSON([
                'success' => false,
                'errors' => $validation->getErrors(),
                'csrf' => csrf_hash(),
            ]);
        }
        $model = new IframeModel();
        $data = [
            'website'    => $this->request->getPost('website'),
            'category'   => $this->request->getPost('category'),
            'iframe_url' => $this->request->getPost('iframe_url'),
            'optin'      => $this->request->getPost('optin') ? 1 : 0,
            'user_id'    => (int) session()->get('admin_id'),
            'ip_address' => (string) $this->request->getIPAddress(),
            'user_agent' => mb_substr((string) $this->request->getUserAgent(), 0, 255),
        ];
        // Handle image upload
        $imageFile = $this->request->getFile('image');
        if ($imageFile && $imageFile->isValid() && !$imageFile->hasMoved()) {
            $newName = $imageFile->getRandomName();
            $publicPath = FCPATH . 'images/iframe';
            if (!is_dir($publicPath)) {
                mkdir($publicPath, 0777, true);
            }
            $imageFile->move($publicPath, $newName);
            $data['image'] = $newName;
        }
        $model->insert($data);
        return $this->response->setJSON([
            'success' => true,
            'message' => 'Iframe entry added successfully',
            'csrf' => csrf_hash(),
        ]);
    }

    // Update iframe entry
    public function update($id)
    {
        if (!$this->request->isAJAX()) {
            return $this->failForbidden('AJAX only');
        }
        $validation = \Config\Services::validation();
        $rules = [
            'website' => 'required|max_length[255]',
            'category' => 'required|max_length[100]',
            'iframe_url' => 'required|valid_url|max_length[1000]',
            'optin' => 'permit_empty|in_list[0,1]',
            'image' => 'permit_empty|is_image[image]|max_size[image,2048]'
        ];
        if (! $this->validate($rules)) {
            return $this->response->setJSON([
                'success' => false,
                'errors' => $validation->getErrors(),
                'csrf' => csrf_hash(),
            ]);
        }
        $model = new IframeModel();
        $data = [
            'website' => $this->request->getPost('website'),
            'category' => $this->request->getPost('category'),
            'iframe_url' => $this->request->getPost('iframe_url'),
            'optin' => $this->request->getPost('optin') ? 1 : 0,
        ];
        // Handle image upload
        $imageFile = $this->request->getFile('image');
        if ($imageFile && $imageFile->isValid() && !$imageFile->hasMoved()) {
            $newName = $imageFile->getRandomName();
            $publicPath = FCPATH . 'images/iframe';
            if (!is_dir($publicPath)) {
                mkdir($publicPath, 0777, true);
            }
            $imageFile->move($publicPath, $newName);
            $data['image'] = $newName;
        }
        $model->update($id, $data);
        return $this->response->setJSON([
            'success' => true,
            'message' => 'Iframe entry updated successfully',
            'csrf' => csrf_hash(),
        ]);
    }

    // Delete iframe entry
    public function delete($id)
    {
        if (!$this->request->isAJAX()) {
            return $this->failForbidden('AJAX only');
        }
        $model = new IframeModel();
        $row = $model->find($id);
        if (!$row) {
            return $this->response->setJSON(['success' => false, 'message' => 'Not found', 'csrf' => csrf_hash()]);
        }
        // Optionally delete image file
        if (!empty($row['image']) && file_exists(FCPATH . $row['image'])) {
            @unlink(FCPATH . $row['image']);
        }
        $model->delete($id);
        return $this->response->setJSON([
            'success' => true,
            'message' => 'Iframe entry deleted',
            'csrf' => csrf_hash(),
        ]);
    }
}