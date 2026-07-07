<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\SurveyLanderModel;
use App\Models\SurveyQuestionsModel;
use App\Models\SurveySubmitModel;

class SurveyController extends BaseController
{
    /**
     * Public survey view page — no auth required.
     * URL: /survey/view/{id}
     */
    public function view(int $id)
    {
        $model  = new SurveyLanderModel();
        $survey = $model->find($id);

        if (!$survey) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $qModel    = new SurveyQuestionsModel();
        $questions = $qModel->where('survey_id', $id)
            ->orderBy('sort_order', 'asc')
            ->findAll();

        $imageUrl = !empty($survey['img_path'])
            ? base_url('uploads/surveyimage/' . $survey['img_path'])
            : null;

        return view('User/survey-view', [
            'survey'       => $survey,
            'questions'    => $questions,
            'imageUrl'     => $imageUrl,
            'flashSuccess' => session()->getFlashdata('success'),
            'flashError'   => session()->getFlashdata('error'),
        ]);
    }

    /**
     * Handle survey form submission (AJAX POST).
     * URL: /survey/submit/{id}
     * Saves each Q/A pair as a separate row in tbl_survey_submit.
     */
    public function submit(int $id)
    {
        if (!$this->request->isAJAX()) {
            return redirect()->to(base_url('survey/view/' . $id));
        }

        if (!$this->validateCsrfAjax()) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Invalid security token. Please refresh the page and try again.',
                'csrf'    => csrf_hash(),
            ]);
        }

        $model  = new SurveyLanderModel();
        $survey = $model->find($id);

        if (!$survey) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Survey not found.',
                'csrf'    => csrf_hash(),
            ]);
        }

        // Validate email
        $email = trim((string) ($this->request->getPost('emailid') ?? ''));
        if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $this->response->setJSON([
                'success' => false,
                'errors'  => ['emailid' => 'A valid email address is required.'],
                'csrf'    => csrf_hash(),
            ]);
        }
        if (strlen($email) > 100) {
            return $this->response->setJSON([
                'success' => false,
                'errors'  => ['emailid' => 'Email must be 100 characters or fewer.'],
                'csrf'    => csrf_hash(),
            ]);
        }

        // Load questions to validate Q1 required
        $qModel    = new SurveyQuestionsModel();
        $questions = $qModel->where('survey_id', $id)
            ->orderBy('sort_order', 'asc')
            ->findAll();

        $answers = $this->request->getPost('answer') ?? [];
        $errors  = [];

        if (!empty($questions)) {
            $firstQ = $questions[0];
            $firstAnswer = trim((string) ($answers[$firstQ['id']] ?? ''));
            if ($firstAnswer === '') {
                $errors['answer-' . $firstQ['id']] = 'This answer is required.';
            }
        }

        if (!empty($errors)) {
            return $this->response->setJSON([
                'success' => false,
                'errors'  => $errors,
                'csrf'    => csrf_hash(),
            ]);
        }

        // Persist to tbl_survey_submit — one row per answered question
        $submitModel = new SurveySubmitModel();
        $ipAddress   = $this->request->getIPAddress();
        $userAgent   = substr((string) $this->request->getUserAgent()->getAgentString(), 0, 255);

        foreach ($questions as $idx => $q) {
            $rawAnswer = trim((string) ($answers[$q['id']] ?? ''));
            if ($rawAnswer === '' && $idx > 0) {
                continue; // skip unanswered optional questions
            }

            $safeAnswer = htmlspecialchars(strip_tags($rawAnswer), ENT_QUOTES, 'UTF-8');

            $submitModel->insert([
                'survey_id'  => (string) $id,
                'Questionno' => (string) ($idx + 1),
                'answers'    => $safeAnswer,
                'emailid'    => $email,
                'ip_address' => $ipAddress,
                'user_agent' => $userAgent,
            ]);
        }

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Thank you! Your responses have been submitted.',
            'csrf'    => csrf_hash(),
        ]);
    }
}
