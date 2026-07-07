<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DirectUploadModel;

class DirectController extends BaseController
{
    public function list()
    {
        if (! $this->request->isAJAX()) {
            return $this->response->setStatusCode(403)->setJSON(['success' => false]);
        }

        $model = new DirectUploadModel();
        $db = db_connect();
        $page = max(1, (int) ($this->request->getGet('page') ?? 1));
        $perPageInput = (int) ($this->request->getGet('per_page') ?? 10);
        $perPage = in_array($perPageInput, [10, 25, 50], true) ? $perPageInput : 10;

        $sortField = (string) ($this->request->getGet('sort_field') ?? 'id');
        $sortDir = strtolower((string) ($this->request->getGet('sort_dir') ?? 'desc')) === 'asc' ? 'asc' : 'desc';
        $search = trim((string) ($this->request->getGet('search') ?? ''));

        $allowedSortFields = ['id', 'img_title', 'CampaignId', 'date'];
        if (! in_array($sortField, $allowedSortFields, true)) {
            $sortField = 'id';
        }

        $countBuilder = $db->table('tbl_uploads')
            ->join('admins', 'admins.id = tbl_uploads.user_id', 'left');
        $listBuilder = $db->table('tbl_uploads')
            ->select('tbl_uploads.*, admins.name AS admin_name')
            ->join('admins', 'admins.id = tbl_uploads.user_id', 'left');

        if ($search !== '') {
            $terms = array_values(array_filter(preg_split('/\s+/', $search) ?: []));

            $applySearch = static function ($builder, array $terms, string $search): void {
                $builder->groupStart();

                // For multi-word input, require all words to exist in title for more accurate matches.
                $builder->groupStart();
                foreach ($terms as $term) {
                    $builder->like('tbl_uploads.img_title', $term);
                }
                $builder->groupEnd();

                // Keep Campaign ID support for short/single-token searches.
                if (count($terms) <= 1) {
                    $builder->orLike('tbl_uploads.CampaignId', $search);
                }

                $builder->groupEnd();
            };

            $applySearch($countBuilder, $terms, $search);
            $applySearch($listBuilder, $terms, $search);
        }

        $total = (int) $countBuilder->countAllResults();
        $offset = ($page - 1) * $perPage;
        $items = $listBuilder->orderBy('tbl_uploads.' . $sortField, $sortDir)
            ->limit($perPage, $offset)
            ->get()
            ->getResultArray();

        foreach ($items as &$item) {
            $item['added_by'] = ((int) ($item['user_id'] ?? 0) === 0)
                ? 'Super Admin'
                : ((string) ($item['admin_name'] ?? '') !== '' ? (string) $item['admin_name'] : 'Admin');
            $item['pdf_url'] = base_url('uploads/directpdf/' . (string) ($item['file'] ?? ''));
            $item['image_url'] = base_url('uploads/directimages/' . (string) ($item['img_path'] ?? ''));
            $item['public_url'] = base_url('whitepaper/view/' . (int) $item['id']);
        }

        return $this->response->setJSON([
            'success' => true,
            'data' => [
                'items' => $items,
                'pagination' => [
                    'page' => $page,
                    'per_page' => $perPage,
                    'total' => $total,
                    'last_page' => max(1, (int) ceil($total / $perPage)),
                ],
            ],
            'csrf' => csrf_hash(),
        ]);
    }

    public function get(int $id)
    {
        if (! $this->request->isAJAX()) {
            return $this->response->setStatusCode(403)->setJSON(['success' => false]);
        }

        $model = new DirectUploadModel();
        $row = $model
            ->select('tbl_uploads.*, admins.name AS admin_name')
            ->join('admins', 'admins.id = tbl_uploads.user_id', 'left')
            ->where('tbl_uploads.id', $id)
            ->first();

        if (! $row) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Record not found.',
                'csrf' => csrf_hash(),
            ]);
        }

        $row['added_by'] = ((int) ($row['user_id'] ?? 0) === 0)
            ? 'Super Admin'
            : ((string) ($row['admin_name'] ?? '') !== '' ? (string) $row['admin_name'] : 'Admin');
        $row['pdf_url'] = base_url('uploads/directpdf/' . (string) ($row['file'] ?? ''));
        $row['image_url'] = base_url('uploads/directimages/' . (string) ($row['img_path'] ?? ''));
        $row['public_url'] = base_url('whitepaper/view/' . (int) $row['id']);

        return $this->response->setJSON([
            'success' => true,
            'data' => $row,
            'csrf' => csrf_hash(),
        ]);
    }

    public function create()
    {
        if (! $this->request->isAJAX()) {
            return $this->response->setStatusCode(403)->setJSON(['success' => false]);
        }

        $rules = [
            'title' => 'required|max_length[255]',
            'description' => 'required|max_length[5000]',
            'CampaignId' => 'required|max_length[100]|regex_match[/^[A-Za-z0-9_ -]+$/]',
            'google' => 'required|in_list[Yes,No]',
            'file' => 'uploaded[file]|ext_in[file,pdf]|mime_in[file,application/pdf,application/x-pdf]|max_size[file,15360]',
            'fileToUpload' => 'uploaded[fileToUpload]|is_image[fileToUpload]|mime_in[fileToUpload,image/png,image/jpeg,image/gif,image/webp]|max_size[fileToUpload,5120]',
        ];

        $messages = [
            'CampaignId' => [
                'regex_match' => 'Campaign ID allows only letters, numbers, spaces, dash, and underscore.',
            ],
            'file' => [
                'uploaded' => 'PDF file is required.',
                'ext_in' => 'Only PDF files are allowed.',
                'mime_in' => 'Invalid PDF file type.',
                'max_size' => 'PDF must be smaller than 15 MB.',
            ],
            'fileToUpload' => [
                'uploaded' => 'Image file is required.',
                'is_image' => 'Only image files are allowed.',
                'mime_in' => 'Image must be PNG, JPG, JPEG, GIF, or WEBP.',
                'max_size' => 'Image must be smaller than 5 MB.',
            ],
        ];

        if (! $this->validate($rules, $messages)) {
            return $this->response->setJSON([
                'success' => false,
                'errors' => $this->validator->getErrors(),
                'csrf' => csrf_hash(),
            ]);
        }

        $pdfFile = $this->request->getFile('file');
        $imgFile = $this->request->getFile('fileToUpload');

        $pdfName = '';
        $imgName = '';

        try {
            $pdfDir = FCPATH . 'uploads/directpdf/';
            $imgDir = FCPATH . 'uploads/directimages/';
            if (! is_dir($pdfDir)) {
                mkdir($pdfDir, 0755, true);
            }
            if (! is_dir($imgDir)) {
                mkdir($imgDir, 0755, true);
            }

            $pdfName = $pdfFile->getRandomName();
            $imgName = $imgFile->getRandomName();

            $pdfFile->move($pdfDir, $pdfName);
            $imgFile->move($imgDir, $imgName);

            $model = new DirectUploadModel();
            $model->insert([
                'user_id' => (int) (session()->get('admin_id') ?? 0),
                'file' => $pdfName,
                'type' => $pdfFile->getClientMimeType(),
                'size' => (int) $pdfFile->getSize(),
                'img_title' => $this->cleanInput((string) $this->request->getPost('title')),
                'img_desc' => $this->cleanInput((string) $this->request->getPost('description')),
                'img_path' => $imgName,
                'CampaignId' => $this->cleanInput((string) $this->request->getPost('CampaignId')),
                'google' => (string) $this->request->getPost('google'),
                'ip_address' => (string) $this->request->getIPAddress(),
                'user_agent' => mb_substr((string) $this->request->getUserAgent(), 0, 255),
                'date' => date('Y-m-d H:i:s'),
            ]);
        } catch (\Throwable $e) {
            if ($pdfName !== '' && file_exists(FCPATH . 'uploads/directpdf/' . $pdfName)) {
                @unlink(FCPATH . 'uploads/directpdf/' . $pdfName);
            }
            if ($imgName !== '' && file_exists(FCPATH . 'uploads/directimages/' . $imgName)) {
                @unlink(FCPATH . 'uploads/directimages/' . $imgName);
            }

            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'errors' => ['database' => 'Could not save the record right now. Please try again.'],
                'csrf' => csrf_hash(),
            ]);
        }

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Direct record created successfully.',
            'csrf' => csrf_hash(),
        ]);
    }

    public function update(int $id)
    {
        if (! $this->request->isAJAX()) {
            return $this->response->setStatusCode(403)->setJSON(['success' => false]);
        }

        $model = new DirectUploadModel();
        $existing = $model->find($id);
        if (! $existing) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Record not found.',
                'csrf' => csrf_hash(),
            ]);
        }

        $rules = [
            'title' => 'required|max_length[255]',
            'description' => 'required|max_length[5000]',
            'CampaignId' => 'required|max_length[100]|regex_match[/^[A-Za-z0-9_ -]+$/]',
            'google' => 'required|in_list[Yes,No]',
            'file' => 'permit_empty|ext_in[file,pdf]|mime_in[file,application/pdf,application/x-pdf]|max_size[file,15360]',
            'fileToUpload' => 'permit_empty|is_image[fileToUpload]|mime_in[fileToUpload,image/png,image/jpeg,image/gif,image/webp]|max_size[fileToUpload,5120]',
        ];

        $messages = [
            'CampaignId' => [
                'regex_match' => 'Campaign ID allows only letters, numbers, spaces, dash, and underscore.',
            ],
            'file' => [
                'ext_in' => 'Only PDF files are allowed.',
                'mime_in' => 'Invalid PDF file type.',
                'max_size' => 'PDF must be smaller than 15 MB.',
            ],
            'fileToUpload' => [
                'is_image' => 'Only image files are allowed.',
                'mime_in' => 'Image must be PNG, JPG, JPEG, GIF, or WEBP.',
                'max_size' => 'Image must be smaller than 5 MB.',
            ],
        ];

        if (! $this->validate($rules, $messages)) {
            return $this->response->setJSON([
                'success' => false,
                'errors' => $this->validator->getErrors(),
                'csrf' => csrf_hash(),
            ]);
        }

        $pdfFile = $this->request->getFile('file');
        $imgFile = $this->request->getFile('fileToUpload');

        $data = [
            'img_title' => $this->cleanInput((string) $this->request->getPost('title')),
            'img_desc' => $this->cleanInput((string) $this->request->getPost('description')),
            'CampaignId' => $this->cleanInput((string) $this->request->getPost('CampaignId')),
            'google' => (string) $this->request->getPost('google'),
        ];

        try {
            if ($pdfFile && $pdfFile->isValid() && ! $pdfFile->hasMoved()) {
                $pdfDir = FCPATH . 'uploads/directpdf/';
                if (! is_dir($pdfDir)) {
                    mkdir($pdfDir, 0755, true);
                }
                $newPdf = $pdfFile->getRandomName();
                $pdfFile->move($pdfDir, $newPdf);
                $data['file'] = $newPdf;
                $data['type'] = $pdfFile->getClientMimeType();
                $data['size'] = (int) $pdfFile->getSize();

                if (! empty($existing['file']) && file_exists($pdfDir . $existing['file'])) {
                    @unlink($pdfDir . $existing['file']);
                }
            }

            if ($imgFile && $imgFile->isValid() && ! $imgFile->hasMoved()) {
                $imgDir = FCPATH . 'uploads/directimages/';
                if (! is_dir($imgDir)) {
                    mkdir($imgDir, 0755, true);
                }
                $newImg = $imgFile->getRandomName();
                $imgFile->move($imgDir, $newImg);
                $data['img_path'] = $newImg;

                if (! empty($existing['img_path']) && file_exists($imgDir . $existing['img_path'])) {
                    @unlink($imgDir . $existing['img_path']);
                }
            }

            $model->update($id, $data);
        } catch (\Throwable $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'errors' => ['database' => 'Could not update the record right now. Please try again.'],
                'csrf' => csrf_hash(),
            ]);
        }

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Direct record updated successfully.',
            'csrf' => csrf_hash(),
        ]);
    }

    public function delete(int $id)
    {
        if (! $this->request->isAJAX()) {
            return $this->response->setStatusCode(403)->setJSON(['success' => false]);
        }

        $model = new DirectUploadModel();
        $row = $model->find($id);
        if (! $row) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Record not found.',
                'csrf' => csrf_hash(),
            ]);
        }

        $model->delete($id);

        if (! empty($row['file'])) {
            $pdfPath = FCPATH . 'uploads/directpdf/' . $row['file'];
            if (file_exists($pdfPath)) {
                @unlink($pdfPath);
            }
        }
        if (! empty($row['img_path'])) {
            $imgPath = FCPATH . 'uploads/directimages/' . $row['img_path'];
            if (file_exists($imgPath)) {
                @unlink($imgPath);
            }
        }

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Direct record deleted successfully.',
            'csrf' => csrf_hash(),
        ]);
    }

    public function view(int $id)
    {
        $model = new DirectUploadModel();
        $row = $model->find($id);

        if (! $row) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $row['pdf_url']   = base_url('uploads/directpdf/' . (string) ($row['file'] ?? ''));
        $row['image_url'] = base_url('uploads/directimages/' . (string) ($row['img_path'] ?? ''));

        return view('User/direct-view', ['record' => $row]);
    }

    private function cleanInput(string $value): string
    {
        return htmlspecialchars(strip_tags(trim($value)), ENT_QUOTES, 'UTF-8');
    }
}
