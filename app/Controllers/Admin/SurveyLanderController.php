<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SurveyLanderModel;
use App\Models\SurveyQuestionsModel;
use App\Models\SurveySubmitModel;

class SurveyLanderController extends BaseController
{
    // List all survey landers (AJAX)
    public function list()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(403)->setJSON(['success' => false]);
        }
        $model  = new SurveyLanderModel();
        $page   = max(1, (int) $this->request->getGet('page'));
        $perPage = max(1, (int) $this->request->getGet('per_page') ?: 10);
        $sortField = in_array($this->request->getGet('sort_field'), ['id', 'survey_name', 'button_value', 'created_at'])
            ? $this->request->getGet('sort_field') : 'id';
        $sortDir = strtolower($this->request->getGet('sort_dir')) === 'desc' ? 'desc' : 'asc';
        $search  = trim($this->request->getGet('search') ?? '');

        $builder = $model;
        if ($search !== '') {
            $builder = $builder->groupStart()
                ->like('survey_name', $search)
                ->orLike('img_title', $search)
                ->orLike('button_value', $search)
                ->groupEnd();
        }
        $total = (clone $builder)->countAllResults();
        $items = $builder->orderBy($sortField, $sortDir)
            ->paginate($perPage, 'default', $page);
        $pager = $model->pager;

        foreach ($items as &$item) {
            $item['public_url'] = base_url('survey/view/' . (int) $item['id']);
        }
        unset($item);

        return $this->response->setJSON([
            'success' => true,
            'data'    => [
                'items'      => $items,
                'pagination' => [
                    'page'      => $page,
                    'per_page'  => $perPage,
                    'total'     => $total,
                    'last_page' => $pager->getPageCount(),
                ],
            ],
        ]);
    }

    // Get single survey lander with its questions (AJAX)
    public function get($id)
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(403)->setJSON(['success' => false]);
        }
        $model   = new SurveyLanderModel();
        $qModel  = new SurveyQuestionsModel();
        $survey  = $model->find((int) $id);
        if (!$survey) {
            return $this->response->setJSON(['success' => false, 'message' => 'Not found']);
        }
        $questions = $qModel->where('survey_id', $survey['id'])->orderBy('sort_order', 'asc')->findAll();
        return $this->response->setJSON([
            'success'   => true,
            'data'      => $survey,
            'questions' => $questions,
            'csrf'      => csrf_hash(),
        ]);
    }

    // Create a new survey lander (AJAX POST)
    public function create()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(403)->setJSON(['success' => false]);
        }

        $validation = \Config\Services::validation();
        $rules = [
            'survey_name'  => 'required|max_length[255]',
            'button_value' => 'required|max_length[100]',
            'img_title'    => 'required|max_length[255]',
            'img_desc'     => 'required|max_length[5000]',
            'file'         => 'uploaded[file]|ext_in[file,pdf]|max_size[file,15360]',
            'fileToUpload' => 'uploaded[fileToUpload]|is_image[fileToUpload]|max_size[fileToUpload,5120]',
        ];
        $messages = [
            'file'         => ['uploaded' => 'PDF file is required.', 'ext_in' => 'Only PDF files are allowed.', 'max_size' => 'PDF must be under 15 MB.'],
            'fileToUpload' => ['uploaded' => 'Image file is required.', 'is_image' => 'Only image files are allowed.', 'max_size' => 'Image must be under 5 MB.'],
        ];

        if (!$this->validate($rules, $messages)) {
            return $this->response->setJSON([
                'success' => false,
                'errors'  => $validation->getErrors(),
                'csrf'    => csrf_hash(),
            ]);
        }

        // Handle PDF upload
        $pdfFile   = $this->request->getFile('file');
        $pdfName   = null;
        $pdfMime   = null;
        $pdfSize   = null;
        if ($pdfFile && $pdfFile->isValid() && !$pdfFile->hasMoved()) {
            $pdfName = $pdfFile->getRandomName();
            $pdfDir  = FCPATH . 'uploads/surveypdf/';
            if (!is_dir($pdfDir)) {
                mkdir($pdfDir, 0755, true);
            }
            $pdfFile->move($pdfDir, $pdfName);
            $pdfMime = $pdfFile->getClientMimeType();
            $pdfSize = $pdfFile->getSize();
        }

        // Handle image upload
        $imgFile  = $this->request->getFile('fileToUpload');
        $imgName  = null;
        if ($imgFile && $imgFile->isValid() && !$imgFile->hasMoved()) {
            $imgName = $imgFile->getRandomName();
            $imgDir  = FCPATH . 'uploads/surveyimage/';
            if (!is_dir($imgDir)) {
                mkdir($imgDir, 0755, true);
            }
            $imgFile->move($imgDir, $imgName);
        }

        $model = new SurveyLanderModel();
        $surveyId = $model->insert([
            'survey_name'  => $this->cleanInput($this->request->getPost('survey_name')),
            'button_value' => $this->cleanInput($this->request->getPost('button_value')),
            'file'         => $pdfName,
            'file_mime'    => $pdfMime,
            'file_size'    => $pdfSize,
            'img_title'    => $this->cleanInput($this->request->getPost('img_title')),
            'img_desc'     => $this->cleanInput($this->request->getPost('img_desc')),
            'img_path'     => $imgName,
            'privacy'      => $this->cleanInput($this->request->getPost('privacy') ?? ''),
            'position'     => $this->request->getPost('position') ?? '',
            'user_id'      => (int) session()->get('admin_id'),
            'ip_address'   => (string) $this->request->getIPAddress(),
            'user_agent'   => mb_substr((string) $this->request->getUserAgent(), 0, 255),
        ]);

        // Save questions
        $this->saveQuestions((int) $surveyId);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Survey lander created successfully.',
            'csrf'    => csrf_hash(),
        ]);
    }

    // Update an existing survey lander (AJAX POST)
    public function update($id)
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(403)->setJSON(['success' => false]);
        }

        $model  = new SurveyLanderModel();
        $survey = $model->find((int) $id);
        if (!$survey) {
            return $this->response->setJSON(['success' => false, 'message' => 'Not found', 'csrf' => csrf_hash()]);
        }

        $validation = \Config\Services::validation();
        $rules = [
            'survey_name'  => 'required|max_length[255]',
            'button_value' => 'required|max_length[100]',
            'img_title'    => 'required|max_length[255]',
            'img_desc'     => 'required|max_length[5000]',
        ];

        $pdfFile = $this->request->getFile('file');
        if ($pdfFile && $pdfFile->isValid()) {
            $rules['file'] = 'ext_in[file,pdf]|max_size[file,15360]';
        }
        $imgFile = $this->request->getFile('fileToUpload');
        if ($imgFile && $imgFile->isValid()) {
            $rules['fileToUpload'] = 'is_image[fileToUpload]|max_size[fileToUpload,5120]';
        }

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'success' => false,
                'errors'  => $validation->getErrors(),
                'csrf'    => csrf_hash(),
            ]);
        }

        $data = [
            'survey_name'  => $this->cleanInput($this->request->getPost('survey_name')),
            'button_value' => $this->cleanInput($this->request->getPost('button_value')),
            'img_title'    => $this->cleanInput($this->request->getPost('img_title')),
            'img_desc'     => $this->cleanInput($this->request->getPost('img_desc')),
            'privacy'      => $this->cleanInput($this->request->getPost('privacy') ?? ''),
            'position'     => $this->request->getPost('position') ?? '',
        ];

        // Handle PDF replacement
        if ($pdfFile && $pdfFile->isValid() && !$pdfFile->hasMoved()) {
            // Delete old PDF
            if ($survey['file']) {
                $oldPdf = FCPATH . 'uploads/surveypdf/' . $survey['file'];
                if (file_exists($oldPdf)) {
                    @unlink($oldPdf);
                }
            }
            $pdfName = $pdfFile->getRandomName();
            $pdfDir  = FCPATH . 'uploads/surveypdf/';
            if (!is_dir($pdfDir)) {
                mkdir($pdfDir, 0755, true);
            }
            $pdfFile->move($pdfDir, $pdfName);
            $data['file']      = $pdfName;
            $data['file_mime'] = $pdfFile->getClientMimeType();
            $data['file_size'] = $pdfFile->getSize();
        }

        // Handle image replacement
        if ($imgFile && $imgFile->isValid() && !$imgFile->hasMoved()) {
            // Delete old image
            if ($survey['img_path']) {
                $oldImg = FCPATH . 'uploads/surveyimage/' . $survey['img_path'];
                if (file_exists($oldImg)) {
                    @unlink($oldImg);
                }
            }
            $imgName = $imgFile->getRandomName();
            $imgDir  = FCPATH . 'uploads/surveyimage/';
            if (!is_dir($imgDir)) {
                mkdir($imgDir, 0755, true);
            }
            $imgFile->move($imgDir, $imgName);
            $data['img_path'] = $imgName;
        }

        $model->update((int) $id, $data);

        // Replace questions (delete old, insert new)
        $qModel = new SurveyQuestionsModel();
        $qModel->where('survey_id', (int) $id)->delete();
        $this->saveQuestions((int) $id);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Survey lander updated successfully.',
            'csrf'    => csrf_hash(),
        ]);
    }

    // Delete a survey lander (AJAX POST)
    public function delete($id)
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(403)->setJSON(['success' => false]);
        }
        $model  = new SurveyLanderModel();
        $survey = $model->find((int) $id);
        if (!$survey) {
            return $this->response->setJSON(['success' => false, 'message' => 'Not found', 'csrf' => csrf_hash()]);
        }

        // Delete PDF file
        if ($survey['file']) {
            $oldPdf = FCPATH . 'uploads/surveypdf/' . $survey['file'];
            if (file_exists($oldPdf)) {
                @unlink($oldPdf);
            }
        }
        // Delete image file
        if ($survey['img_path']) {
            $oldImg = FCPATH . 'uploads/surveyimage/' . $survey['img_path'];
            if (file_exists($oldImg)) {
                @unlink($oldImg);
            }
        }

        // Delete questions
        $qModel = new SurveyQuestionsModel();
        $qModel->where('survey_id', (int) $id)->delete();
        $model->delete((int) $id);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Survey lander deleted successfully.',
            'csrf'    => csrf_hash(),
        ]);
    }

    // Save questions from POST data
    private function saveQuestions(int $surveyId): void
    {
        $qModel = new SurveyQuestionsModel();
        for ($i = 1; $i <= 10; $i++) {
            $question = trim($this->request->getPost('question' . $i) ?? '');
            if ($question === '') {
                continue;
            }
            $type    = $this->request->getPost('options' . $i) ?? '';
            $isTextbox = ($type === 'textbox' . $i || $type === 'textbox');

            $qModel->insert([
                'survey_id'     => $surveyId,
                'question'      => $this->cleanInput($question),
                'question_type' => $isTextbox ? 'textbox' : 'options',
                'option1'       => $isTextbox ? null : $this->cleanInput($this->request->getPost('Q' . $i . '_ans1') ?? ''),
                'option2'       => $isTextbox ? null : $this->cleanInput($this->request->getPost('Q' . $i . '_ans2') ?? ''),
                'option3'       => $isTextbox ? null : $this->cleanInput($this->request->getPost('Q' . $i . '_ans3') ?? ''),
                'option4'       => $isTextbox ? null : $this->cleanInput($this->request->getPost('Q' . $i . '_ans4') ?? ''),
                'option5'       => $isTextbox ? null : $this->cleanInput($this->request->getPost('Q' . $i . '_ans5') ?? ''),
                'option6'       => $isTextbox ? null : $this->cleanInput($this->request->getPost('Q' . $i . '_ans6') ?? ''),
                'sort_order'    => $i,
                'user_id'       => (int) session()->get('admin_id'),
                'ip_address'    => (string) $this->request->getIPAddress(),
                'user_agent'    => mb_substr((string) $this->request->getUserAgent(), 0, 255),
            ]);
        }
    }

    private function cleanInput(string $value): string
    {
        return htmlspecialchars(strip_tags(trim($value)), ENT_QUOTES, 'UTF-8');
    }

    // ── Survey Responses ────────────────────────────────────────

    /**
     * AJAX: paginated list of survey responses from tbl_survey_submit.
     * GET params: page, per_page, survey_id (filter), search (email), sort_field, sort_dir
     */
    public function responsesList()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(403)->setJSON(['success' => false]);
        }

        $db      = db_connect();
        $page    = max(1, (int) $this->request->getGet('page'));
        $perPage = max(1, (int) ($this->request->getGet('per_page') ?: 10));
        $offset  = ($page - 1) * $perPage;

        $surveyId = (int) $this->request->getGet('survey_id');
        $search   = trim((string) ($this->request->getGet('search') ?? ''));
        $sortField = (string) ($this->request->getGet('sort_field') ?? 'id');
        $sortDir = strtolower($this->request->getGet('sort_dir')) === 'asc' ? 'ASC' : 'DESC';

        $sortMap = [
            'id'            => 'MAX(sr.id)',
            'survey_id'     => 'sr.survey_id',
            'emailid'       => 'sr.emailid',
            'total_answers' => 'COUNT(*)',
            'submitted_at'  => 'MAX(sr.created_at)',
        ];
        if (! array_key_exists($sortField, $sortMap)) {
            $sortField = 'id';
        }

        // Build grouped user-wise response list (one row per survey + user email).
        $builder = $db->table('tbl_survey_submit sr')
            ->select('MAX(sr.id) AS id, sr.survey_id, sr.emailid, MAX(sr.ip_address) AS ip_address, MAX(sr.created_at) AS submitted_at, COUNT(*) AS total_answers,
                      sl.survey_name')
            ->join('tbl_survey sl', 'sl.id = sr.survey_id', 'left');

        if ($surveyId > 0) {
            $builder->where('sr.survey_id', $surveyId);
        }
        if ($search !== '') {
            $builder->groupStart()
                ->like('sr.emailid', $search)
                ->orLike('sl.survey_name', $search)
                ->groupEnd();
        }

        $builder->groupBy('sr.survey_id, sr.emailid');

        $total   = (clone $builder)->countAllResults();
        $items   = $builder->orderBy($sortMap[$sortField], $sortDir)
            ->limit($perPage, $offset)
            ->get()->getResultArray();

        // Load all survey names for the filter dropdown
        $surveys = $db->table('tbl_survey')->select('id, survey_name')->orderBy('survey_name', 'ASC')->get()->getResultArray();

        return $this->response->setJSON([
            'success' => true,
            'data'    => [
                'items'      => $items,
                'surveys'    => $surveys,
                'pagination' => [
                    'page'      => $page,
                    'per_page'  => $perPage,
                    'total'     => $total,
                    'last_page' => max(1, (int) ceil($total / $perPage)),
                ],
            ],
        ]);
    }

    /**
     * AJAX POST: delete a single survey response row.
     */
    public function responseDelete(int $id)
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(403)->setJSON(['success' => false]);
        }
        if (!$this->validateCsrfAjax()) {
            return $this->response->setJSON(['success' => false, 'message' => 'Invalid token.', 'csrf' => csrf_hash()]);
        }

        $db = db_connect();
        $row = $db->table('tbl_survey_submit')->where('id', $id)->get()->getRowArray();
        if (!$row) {
            return $this->response->setJSON(['success' => false, 'message' => 'Record not found.', 'csrf' => csrf_hash()]);
        }

        $deleted = $db->table('tbl_survey_submit')
            ->where('survey_id', (int) $row['survey_id'])
            ->where('emailid', (string) $row['emailid'])
            ->delete();

        if (! $deleted) {
            return $this->response->setJSON(['success' => false, 'message' => 'Failed to delete user responses.', 'csrf' => csrf_hash()]);
        }

        return $this->response->setJSON(['success' => true, 'message' => 'User responses deleted.', 'csrf' => csrf_hash()]);
    }

    /**
     * AJAX GET: return all question/answer rows for a user-wise response group.
     */
    public function responseUserDetails(int $id)
    {
        if (! $this->request->isAJAX()) {
            return $this->response->setStatusCode(403)->setJSON(['success' => false]);
        }

        $db = db_connect();
        $groupRow = $db->table('tbl_survey_submit')
            ->select('id, survey_id, emailid')
            ->where('id', $id)
            ->get()
            ->getRowArray();

        if (! $groupRow) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Record not found.',
            ]);
        }

        $survey = $db->table('tbl_survey')
            ->select('id, survey_name')
            ->where('id', (int) $groupRow['survey_id'])
            ->get()
            ->getRowArray();

        $items = $db->table('tbl_survey_submit sr')
            ->select('sr.id, sr.Questionno, sr.answers, sq.question AS question_text')
            ->join('tbl_survey_questions sq', 'sq.survey_id = sr.survey_id AND CAST(sq.sort_order AS CHAR) = CAST(sr.Questionno AS CHAR)', 'left')
            ->where('sr.survey_id', (int) $groupRow['survey_id'])
            ->where('sr.emailid', (string) $groupRow['emailid'])
            ->orderBy('sr.Questionno', 'ASC')
            ->orderBy('sr.id', 'ASC')
            ->get()
            ->getResultArray();

        return $this->response->setJSON([
            'success' => true,
            'data' => [
                'survey_id' => (int) $groupRow['survey_id'],
                'survey_name' => $survey['survey_name'] ?? ('Survey #' . (int) $groupRow['survey_id']),
                'emailid' => (string) $groupRow['emailid'],
                'total_answers' => count($items),
                'items' => $items,
            ],
        ]);
    }
}
