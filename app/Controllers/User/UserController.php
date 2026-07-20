<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\ContactUsModel;
use App\Models\PartneringModel;
use App\Models\PublishModel;
use App\Models\SubscribeModel;
use Config\Services;

class UserController extends BaseController
{
    private const DEFAULT_CONTACT_ADMIN_EMAIL = 'admin@theitupdates.com';
    private const RECAPTCHA_V3_ACTION = 'contact_form';

    public function index()
    {
        return view('User/index', [
            'recaptchaSiteKey' => $this->getRecaptchaSiteKey(),
            'recaptchaEnabled' => $this->isRecaptchaConfigured(),
        ]);
    }

    public function about()
    {
        return view('User/about');
    }

    public function services()
    {
        return view('User/services');
    }

    public function whitepaperLibrary()
    {
        $db      = db_connect();
        $perPage = 16;
        $page    = max(1, (int) ($this->request->getGet('page') ?? 1));
        $search  = trim((string) ($this->request->getGet('q') ?? ''));
        $offset  = ($page - 1) * $perPage;

        $countQuery = $db->table('books');
        if ($search !== '') {
            $countQuery->like('name', $search);
        }
        $total = (int) $countQuery->countAllResults();

        $rowQuery = $db->table('books')
            ->select('book_id, name, author, company, image, date')
            ->orderBy('book_id', 'DESC')
            ->limit($perPage, $offset);
        if ($search !== '') {
            $rowQuery->like('name', $search);
        }
        $rows = $rowQuery->get()->getResultArray();

        foreach ($rows as &$row) {
            $img = trim((string) ($row['image'] ?? ''));
            $row['image_url'] = ($img !== '')
                ? base_url('images/books/images/' . $img)
                : null;
            $row['public_url'] = base_url('book/view/' . (int) $row['book_id']);
        }
        unset($row);

        $lastPage = max(1, (int) ceil($total / $perPage));

        return view('User/whitepaper-library', [
            'whitepapers' => $rows,
            'currentPage' => $page,
            'lastPage'    => $lastPage,
            'perPage'     => $perPage,
            'total'       => $total,
            'search'      => $search,
        ]);
    }

    public function bookView(int $bookId)
    {
        $db   = db_connect();
        $book = $db->table('books')
            ->select('book_id, name, description, author, company, subject_area, image, file1, url, type, europe, customquestion, date')
            ->where('book_id', $bookId)
            ->get()
            ->getRowArray();

        if ($book === null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $img = trim((string) ($book['image'] ?? ''));
        $book['image_url'] = ($img !== '') ? base_url('images/books/images/' . $img) : null;

        $file = trim((string) ($book['file1'] ?? ''));
        $book['pdf_url'] = ($file !== '') ? base_url('images/books/pdf/' . $file) : null;
        $book['resource_type'] = ($book['url'] ?? '') !== '' ? 'Url' : 'Download';

        $cqType          = 'none';
        $optionQuestions = [];
        $textQuestions   = [];

        if (($book['customquestion'] ?? '') === 'yes') {
            $cqType          = 'options';
            $optionQuestions = $db->table('tbl_questions')
                ->select('Qid, Question, Option1, Option2, Option3, Option4, Option5, Option6')
                ->where('book_id', $bookId)
                ->orderBy('Qid', 'ASC')
                ->get()
                ->getResultArray();
        } elseif (($book['customquestion'] ?? '') === 'yes_t') {
            $cqType        = 'text';
            $textQuestions = $db->table('tbl_questions_text')
                ->select('Qid, Question')
                ->where('book_id', $bookId)
                ->orderBy('Qid', 'ASC')
                ->get()
                ->getResultArray();
        }

        return view('User/book-view', [
            'book'             => $book,
            'cqType'           => $cqType,
            'optionQuestions'  => $optionQuestions,
            'textQuestions'    => $textQuestions,
            'recaptchaSiteKey' => $this->getRecaptchaSiteKey(),
            'recaptchaEnabled' => $this->isRecaptchaConfigured(),
        ]);
    }

    public function bookDownload(int $bookId)
    {
        if (! $this->request->isAJAX()) {
            return $this->response->setStatusCode(405)->setJSON(['success' => false, 'message' => 'Method Not Allowed']);
        }

        if (! $this->validateCsrfAjax()) {
            return $this->response->setStatusCode(403)->setJSON([
                'success' => false,
                'message' => 'Security token mismatch. Please refresh the page and try again.',
                'csrf'    => csrf_hash(),
            ]);
        }

        $db   = db_connect();
        $book = $db->table('books')
            ->select('book_id, name, file1, url, europe, customquestion')
            ->where('book_id', $bookId)
            ->get()
            ->getRowArray();

        if ($book === null) {
            return $this->response->setStatusCode(404)->setJSON([
                'success' => false,
                'message' => 'Whitepaper not found.',
                'csrf'    => csrf_hash(),
            ]);
        }

        if ($this->isRecaptchaConfigured() && ! $this->verifyRecaptchaToken((string) $this->request->getPost('g-recaptcha-response'), 'book_download')) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'reCAPTCHA verification failed. Please try again.',
                'csrf'    => csrf_hash(),
            ]);
        }

        $rules = [
            'name'      => 'required|min_length[2]|max_length[100]',
            'email'     => 'required|valid_email|max_length[50]',
            'job_title' => 'required|min_length[2]|max_length[100]',
            'company'   => 'required|min_length[2]|max_length[100]',
        ];

        $messages = [
            'name'      => ['required' => 'Full name is required.', 'min_length' => 'Name must be at least 2 characters.'],
            'email'     => ['required' => 'Email is required.', 'valid_email' => 'Please enter a valid email address.'],
            'job_title' => ['required' => 'Job title is required.'],
            'company'   => ['required' => 'Company name is required.'],
        ];

        if (! $this->validate($rules, $messages)) {
            return $this->response->setStatusCode(422)->setJSON([
                'success' => false,
                'errors'  => $this->validator->getErrors(),
                'csrf'    => csrf_hash(),
            ]);
        }

        // Gather custom question answers
        $customQText = '';
        $answersText = '';
        $cqType      = ($book['customquestion'] ?? '');

        if ($cqType === 'yes') {
            $questions = $db->table('tbl_questions')
                ->select('Qid, Question')
                ->where('book_id', $bookId)
                ->orderBy('Qid', 'ASC')
                ->get()
                ->getResultArray();
            $qTexts = [];
            $aTexts = [];
            foreach ($questions as $q) {
                $qTexts[] = $q['Question'];
                $aTexts[] = strip_tags(trim((string) ($this->request->getPost('answer_' . $q['Qid']) ?? '')));
            }
            $customQText = implode(' | ', $qTexts);
            $answersText = implode(' | ', $aTexts);
        } elseif ($cqType === 'yes_t') {
            $questions = $db->table('tbl_questions_text')
                ->select('Qid, Question')
                ->where('book_id', $bookId)
                ->orderBy('Qid', 'ASC')
                ->get()
                ->getResultArray();
            $qTexts = [];
            $aTexts = [];
            foreach ($questions as $q) {
                $qTexts[] = $q['Question'];
                $aTexts[] = strip_tags(trim((string) ($this->request->getPost('answer_' . $q['Qid']) ?? '')));
            }
            $customQText = implode(' | ', $qTexts);
            $answersText = implode(' | ', $aTexts);
        }

        $userId = (int) (session()->get('user_id') ?? 0);
        $file1  = trim((string) ($book['file1'] ?? ''));
        $url    = trim((string) ($book['url'] ?? ''));

        $db->table('downloaded')->insert([
            'book_id'         => $bookId,
            'user_id'         => $userId,
            'name'            => substr(strip_tags(trim((string) $this->request->getPost('name'))), 0, 20),
            'email_id'        => substr(trim((string) $this->request->getPost('email')), 0, 50),
            'job_title'       => substr(strip_tags(trim((string) $this->request->getPost('job_title'))), 0, 20),
            'comp'            => substr(strip_tags(trim((string) $this->request->getPost('company'))), 0, 20),
            'customquestion'  => substr($customQText, 0, 100),
            'answers'         => substr($answersText, 0, 100),
            'if_europe'       => ($book['europe'] ?? '') === 'Europe' ? 'Yes' : '',
            'if_noneurope'    => ($book['europe'] ?? '') === 'non-Europe' ? 'Yes' : '',
            'downloaded_file' => substr($file1, 0, 500),
            'url'             => substr($url, 0, 500),
            'ip_address'      => (string) $this->request->getIPAddress(),
            'user_agent'      => mb_substr((string) $this->request->getUserAgent(), 0, 255),
        ]);

        // Store a session token so the bookPdfServe controller can verify access
        if ($file1 !== '') {
            session()->set('pdf_access_' . $bookId, ['created_at' => time()]);
        }

        return $this->response->setJSON([
            'success'      => true,
            'message'      => 'Thank you! Redirecting...',
            'redirect_url' => base_url('book/thankyou/' . $bookId),
            'csrf'         => csrf_hash(),
        ]);
    }

    public function bookThankyou(int $bookId)
    {
        $db   = db_connect();
        $book = $db->table('books')
            ->select('book_id, name, image, description, url, file1')
            ->where('book_id', $bookId)
            ->get()
            ->getRowArray();

        if ($book === null) {
            return redirect()->to(base_url('whitepaper-library'));
        }

        $book['image_url'] = ! empty($book['image'])
            ? base_url('images/books/images/' . $book['image'])
            : '';

        $file1 = trim((string) ($book['file1'] ?? ''));
        $url   = trim((string) ($book['url']   ?? ''));

        return view('User/book-thankyou', [
            'book'         => $book,
            'pdf_url'      => $file1 !== '' ? base_url('book/pdf/' . $bookId) : null,
            'resource_url' => $url   !== '' ? $url : null,
        ]);
    }

    public function bookPdfServe(int $bookId)
    {
        // Verify the user completed the download form (session token set in bookDownload)
        $token = session()->get('pdf_access_' . $bookId);
        if (! $token || ! isset($token['created_at']) || (time() - (int) $token['created_at']) > 3600) {
            return redirect()->to(base_url('book/view/' . $bookId));
        }

        $db   = db_connect();
        $book = $db->table('books')
            ->select('book_id, name, file1')
            ->where('book_id', $bookId)
            ->get()
            ->getRowArray();

        if (! $book || empty($book['file1'])) {
            return $this->response->setStatusCode(404)->setBody('File not found.');
        }

        // Use basename() to prevent path traversal attacks
        $filename = basename((string) $book['file1']);
        $filePath = FCPATH . 'images/books/pdf/' . $filename;

        if (! is_file($filePath)) {
            return $this->response->setStatusCode(404)->setBody('File not found.');
        }

        log_message('notice', '[PDF Serve] Book ID: ' . $bookId . ' served to IP: ' . $this->request->getIPAddress());

        return $this->response->download($filePath, null, true)
            ->setHeader('X-Content-Type-Options', 'nosniff');
    }

    public function publishWhitepaper()
    {
        return view('User/publish-whitepaper', [
            'recaptchaSiteKey' => $this->getRecaptchaSiteKey(),
            'recaptchaEnabled' => $this->isRecaptchaConfigured(),
        ]);
    }

    public function privacyPolicy()
    {
        return view('User/privacy-policy');
    }

    public function submitPartnering()
    {
        if (! $this->request->isAJAX()) {
            return $this->response->setStatusCode(405)->setBody('Method Not Allowed');
        }

        if (! $this->validateCsrfAjax()) {
            return $this->response->setStatusCode(403)->setJSON([
                'success' => false,
                'message' => 'Security token mismatch. Please refresh the page and try again.',
                'csrf'    => csrf_hash(),
            ]);
        }

        if ($this->isRecaptchaConfigured() && ! $this->verifyRecaptchaToken((string) $this->request->getPost('g-recaptcha-response'), 'partnering_form')) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'reCAPTCHA verification failed. Please try again.',
                'csrf'    => csrf_hash(),
            ]);
        }

        $rules = [
            'name'         => 'required|string|min_length[2]|max_length[150]',
            'job_title'    => 'required|string|max_length[100]',
            'email'        => 'required|valid_email|max_length[150]',
            'company_name' => 'required|string|max_length[150]',
            'industry'     => 'required|string|max_length[100]',
            'phone'        => 'permit_empty|string|max_length[30]',
            'country'      => 'required|string|max_length[100]',
            'message'      => 'permit_empty|string|max_length[2000]',
        ];

        $messages = [
            'name' => [
                'required'   => 'Your name is required.',
                'min_length' => 'Name must be at least 2 characters.',
            ],
            'job_title' => [
                'required' => 'Job title is required.',
            ],
            'email' => [
                'required'    => 'Email address is required.',
                'valid_email' => 'Please enter a valid email address.',
            ],
            'company_name' => [
                'required' => 'Company name is required.',
            ],
            'industry' => [
                'required' => 'Industry is required.',
            ],
            'country' => [
                'required' => 'Country is required.',
            ],
        ];

        if (! $this->validate($rules, $messages)) {
            return $this->response->setJSON([
                'success' => false,
                'errors'  => $this->validator->getErrors(),
                'csrf'    => csrf_hash(),
            ]);
        }

        $model = new PartneringModel();

        $data = [
            'name'         => $this->request->getPost('name'),
            'job_title'    => $this->request->getPost('job_title'),
            'email'        => $this->request->getPost('email'),
            'company_name' => $this->request->getPost('company_name'),
            'industry'     => $this->request->getPost('industry'),
            'phone'        => (string) ($this->request->getPost('phone') ?? ''),
            'country'      => $this->request->getPost('country'),
            'message'      => (string) ($this->request->getPost('message') ?? ''),
            'ip_address'   => (string) $this->request->getIPAddress(),
            'user_agent'   => mb_substr((string) $this->request->getUserAgent(), 0, 255),
        ];

        if ($model->insert($data)) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Thank you for reaching out! We will be in touch with you shortly.',
                'csrf'    => csrf_hash(),
            ]);
        }

        return $this->response->setJSON([
            'success' => false,
            'message' => 'An error occurred while processing your request. Please try again.',
            'csrf'    => csrf_hash(),
        ]);
    }

    public function submitDnc()
    {
        if (! $this->request->isAJAX()) {
            return $this->response->setStatusCode(405)->setBody('Method Not Allowed');
        }

        if (! $this->validateCsrfAjax()) {
            return $this->response->setStatusCode(403)->setJSON([
                'success' => false,
                'message' => 'Security token mismatch. Please refresh the page and try again.',
                'csrf'    => csrf_hash(),
            ]);
        }

        if ($this->isRecaptchaConfigured() && ! $this->verifyRecaptchaToken((string) $this->request->getPost('g-recaptcha-response'), 'dnc_form')) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'reCAPTCHA verification failed. Please try again.',
                'csrf'    => csrf_hash(),
            ]);
        }

        $rules = [
            'first_name'           => 'required|string|min_length[2]|max_length[100]',
            'last_name'            => 'required|string|min_length[2]|max_length[100]',
            'company_name'         => 'required|string|max_length[100]',
            'email'                => 'required|valid_email|max_length[150]',
            'job_title'            => 'required|string|max_length[100]',
            'country'              => 'required|string|max_length[100]',
            'communication_opt_in' => 'required|in_list[Yes,No]',
        ];

        $messages = [
            'first_name' => [
                'required'   => 'First name is required.',
                'min_length' => 'First name must be at least 2 characters.',
            ],
            'last_name' => [
                'required'   => 'Last name is required.',
                'min_length' => 'Last name must be at least 2 characters.',
            ],
            'company_name' => [
                'required' => 'Company name is required.',
            ],
            'email' => [
                'required'    => 'Email is required.',
                'valid_email' => 'Please enter a valid email address.',
            ],
            'job_title' => [
                'required' => 'Job title is required.',
            ],
            'country' => [
                'required' => 'Country is required.',
            ],
            'communication_opt_in' => [
                'required' => 'Please select Yes or No.',
            ],
        ];

        if (! $this->validate($rules, $messages)) {
            return $this->response->setJSON([
                'success' => false,
                'errors'  => $this->validator->getErrors(),
                'csrf'    => csrf_hash(),
            ]);
        }

        $dncModel = new \App\Models\DncModel();
        
        $dncData = [
            'first_name'           => $this->request->getPost('first_name'),
            'last_name'            => $this->request->getPost('last_name'),
            'company_name'         => $this->request->getPost('company_name'),
            'email'                => $this->request->getPost('email'),
            'job_title'            => $this->request->getPost('job_title'),
            'country'              => $this->request->getPost('country'),
            'communication_opt_in' => $this->request->getPost('communication_opt_in'),
            'ip_address'           => (string) $this->request->getIPAddress(),
            'user_agent'           => mb_substr((string) $this->request->getUserAgent(), 0, 255),
        ];

        if ($dncModel->insert($dncData)) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Thank you for your submission. Your information has been received and will be processed.',
                'csrf'    => csrf_hash(),
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'An error occurred while processing your request. Please try again.',
                'csrf'    => csrf_hash(),
            ]);
        }
    }

    public function contact()
    {
        return view('User/contact', [
            'recaptchaSiteKey' => $this->getRecaptchaSiteKey(),
            'recaptchaEnabled' => $this->isRecaptchaConfigured(),
        ]);
    }

    public function submitContact()
    {
        $isAjax = $this->request->isAJAX();

        $rules = [
            'name'    => ['required', 'min_length[2]', 'max_length[120]', 'regex_match[/^[\p{L}\p{M}\s\'\-\.]+$/u]'],
            'email'   => ['required', 'valid_email', 'max_length[190]'],
            'company' => ['required', 'min_length[2]', 'max_length[150]', 'regex_match[/^[\p{L}\p{M}0-9\s\'\-\.&,]+$/u]'],
            'message' => ['required', 'max_length[2000]', 'regex_match[/^[^<>]+$/s]'],
        ];

        $messages = [
            'name' => [
                'required'    => 'Please enter your name.',
                'regex_match' => 'Name must contain only letters, spaces, hyphens, apostrophes, or periods.',
            ],
            'email' => [
                'required'    => 'Please enter your email address.',
                'valid_email' => 'Please enter a valid email address.',
            ],
            'company' => [
                'required'    => 'Please enter your company name.',
                'regex_match' => 'Company name contains invalid characters.',
            ],
            'message' => [
                'required'    => 'Please enter your message.',
                'regex_match' => 'Message must not contain HTML tags or angle brackets.',
            ],
        ];

        if ($this->isRecaptchaConfigured()) {
            $rules['g-recaptcha-response'] = 'required';
            $messages['g-recaptcha-response'] = [
                'required' => 'Google reCAPTCHA validation token is missing. Please try again.',
            ];
        }

        if (! $this->validate($rules, $messages)) {
            if ($isAjax) {
                return $this->response->setStatusCode(422)->setJSON([
                    'success' => false,
                    'errors'  => $this->validator->getErrors(),
                ] + $this->csrfPayload());
            }

            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        if ($this->isRecaptchaConfigured() && ! $this->verifyRecaptchaToken((string) $this->request->getPost('g-recaptcha-response'))) {
            $captchaError = ['captcha' => 'Google reCAPTCHA verification failed. Please try again.'];

            if ($isAjax) {
                return $this->response->setStatusCode(422)->setJSON([
                    'success' => false,
                    'errors'  => $captchaError,
                ] + $this->csrfPayload());
            }

            return redirect()->back()->withInput()->with('errors', $captchaError);
        }

        $contactData = [
            'name'       => strip_tags(trim((string) $this->request->getPost('name'))),
            'email'      => trim((string) $this->request->getPost('email')),
            'company'    => strip_tags(trim((string) $this->request->getPost('company'))),
            'message'    => strip_tags(trim((string) $this->request->getPost('message'))),
            'ip_address' => (string) $this->request->getIPAddress(),
            'user_agent' => substr((string) $this->request->getUserAgent(), 0, 255),
            'email_sent' => 0,
        ];

        $contactModel = new ContactUsModel();
        $contactId    = $contactModel->insert($contactData, true);

        if ($contactId === false) {
            $dbErrors = $contactModel->errors() ?: ['database' => 'We could not save your message. Please try again.'];

            if ($isAjax) {
                return $this->response->setStatusCode(500)->setJSON([
                    'success' => false,
                    'errors'  => $dbErrors,
                ] + $this->csrfPayload());
            }

            return redirect()->back()->withInput()->with('errors', $dbErrors);
        }

        $emailSent = $this->sendContactNotification($contactData);

        if ($emailSent) {
            $contactModel->update($contactId, ['email_sent' => 1]);
        }

        $successMessage = 'Your message has been sent successfully.';
        $warningMessage = 'Your message was saved, but the admin email notification could not be sent. Please verify your mail configuration.';
        $responseMessage = $emailSent ? $successMessage : $warningMessage;

        if ($isAjax) {
            return $this->response->setJSON([
                'success' => true,
                'message' => $responseMessage,
            ] + $this->csrfPayload());
        }

        if ($emailSent) {
            return redirect()->to(base_url('contact'))->with('success', $successMessage);
        }

        return redirect()->to(base_url('contact'))->with('warning', $warningMessage);
    }

    public function submitPublishWhitepaper()
    {
        $isAjax = $this->request->isAJAX();

        $rules = [
            'first_name'   => ['required', 'min_length[2]', 'max_length[100]', 'regex_match[/^[\p{L}\p{M}\s\'\-\.]+$/u]'],
            'last_name'    => ['required', 'min_length[2]', 'max_length[100]', 'regex_match[/^[\p{L}\p{M}\s\'\-\.]+$/u]'],
            'email'        => ['required', 'valid_email', 'max_length[190]'],
            'telephone'    => ['required', 'min_length[5]', 'max_length[30]', 'regex_match[/^[\d\s\+\-\(\)\.]+$/]'],
            'company_name' => ['required', 'min_length[2]', 'max_length[150]', 'regex_match[/^[\p{L}\p{M}0-9\s\'\-\.&,]+$/u]'],
            'zip_code'     => ['required', 'min_length[2]', 'max_length[20]', 'regex_match[/^[a-zA-Z0-9\s\-]+$/]'],
        ];

        $messages = [
            'first_name'           => ['required' => 'Please enter your first name.', 'min_length' => 'First name must be at least 2 characters.', 'regex_match' => 'First name must contain only letters, spaces, hyphens, apostrophes, or periods.'],
            'last_name'            => ['required' => 'Please enter your last name.', 'min_length' => 'Last name must be at least 2 characters.', 'regex_match' => 'Last name must contain only letters, spaces, hyphens, apostrophes, or periods.'],
            'email'                => ['required' => 'Please enter your email address.', 'valid_email' => 'Please enter a valid email address.'],
            'telephone'            => ['required' => 'Please enter your telephone number.', 'min_length' => 'Please enter a valid telephone number.', 'regex_match' => 'Telephone must contain only digits, spaces, +, -, (, or ).'],
            'company_name'         => ['required' => 'Please enter your company name.', 'min_length' => 'Company name must be at least 2 characters.', 'regex_match' => 'Company name contains invalid characters.'],
            'zip_code'             => ['required' => 'Please enter your zip code.', 'min_length' => 'Please enter a valid zip code.', 'regex_match' => 'Zip code must contain only letters, digits, spaces, or hyphens.'],
            'g-recaptcha-response' => ['required' => 'Google reCAPTCHA validation token is missing. Please try again.'],
        ];

        if ($this->isRecaptchaConfigured()) {
            $rules['g-recaptcha-response'] = 'required';
        }

        if (! $this->validate($rules, $messages)) {
            if ($isAjax) {
                return $this->response->setStatusCode(422)->setJSON([
                    'success' => false,
                    'errors'  => $this->validator->getErrors(),
                ] + $this->csrfPayload());
            }

            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        if ($this->isRecaptchaConfigured() && ! $this->verifyRecaptchaToken((string) $this->request->getPost('g-recaptcha-response'), 'publish_whitepaper')) {
            $captchaError = ['captcha' => 'Google reCAPTCHA verification failed. Please try again.'];

            if ($isAjax) {
                return $this->response->setStatusCode(422)->setJSON([
                    'success' => false,
                    'errors'  => $captchaError,
                ] + $this->csrfPayload());
            }

            return redirect()->back()->withInput()->with('errors', $captchaError);
        }

        $publishData = [
            'first_name'   => strip_tags(trim((string) $this->request->getPost('first_name'))),
            'last_name'    => strip_tags(trim((string) $this->request->getPost('last_name'))),
            'email'        => trim((string) $this->request->getPost('email')),
            'telephone'    => strip_tags(trim((string) $this->request->getPost('telephone'))),
            'company_name' => strip_tags(trim((string) $this->request->getPost('company_name'))),
            'zip_code'     => strip_tags(trim((string) $this->request->getPost('zip_code'))),
            'ip_address'   => (string) $this->request->getIPAddress(),
            'user_agent'   => substr((string) $this->request->getUserAgent(), 0, 255),
            'email_sent'   => 0,
        ];

        $publishModel = new PublishModel();
        $insertId     = $publishModel->insert($publishData, true);

        if ($insertId === false) {
            $dbErrors = $publishModel->errors() ?: ['database' => 'Could not save your submission. Please try again.'];

            if ($isAjax) {
                return $this->response->setStatusCode(500)->setJSON([
                    'success' => false,
                    'errors'  => $dbErrors,
                ] + $this->csrfPayload());
            }

            return redirect()->back()->withInput()->with('errors', $dbErrors);
        }

        $emailSent = $this->sendPublishNotification($publishData);

        if ($emailSent) {
            $publishModel->update($insertId, ['email_sent' => 1]);
        }

        $successMessage  = 'Your whitepaper submission has been received. We will be in touch soon.';
        $warningMessage  = 'Your submission was saved, but the admin email notification could not be sent.';
        $responseMessage = $emailSent ? $successMessage : $warningMessage;

        if ($isAjax) {
            return $this->response->setJSON([
                'success' => true,
                'message' => $responseMessage,
            ] + $this->csrfPayload());
        }

        return redirect()->to(base_url('publish-whitepaper'))->with('success', $successMessage);
    }

    public function submitSubscribe()
    {
        $isAjax = $this->request->isAJAX();

        $rules = [
            'email' => ['required', 'valid_email', 'max_length[190]'],
        ];

        $messages = [
            'email' => [
                'required'    => 'Please enter your email address.',
                'valid_email' => 'Please enter a valid email address.',
                'max_length'  => 'Email address is too long.',
            ],
        ];

        if ($this->isRecaptchaConfigured()) {
            $rules['g-recaptcha-response'] = 'required';
            $messages['g-recaptcha-response'] = [
                'required' => 'Google reCAPTCHA validation token is missing. Please try again.',
            ];
        }

        if (! $this->validate($rules, $messages)) {
            if ($isAjax) {
                return $this->response->setStatusCode(422)->setJSON([
                    'success' => false,
                    'errors'  => $this->validator->getErrors(),
                ] + $this->csrfPayload());
            }

            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        if ($this->isRecaptchaConfigured() && ! $this->verifyRecaptchaToken((string) $this->request->getPost('g-recaptcha-response'), 'newsletter_subscribe')) {
            $captchaError = ['captcha' => 'Google reCAPTCHA verification failed. Please try again.'];

            if ($isAjax) {
                return $this->response->setStatusCode(422)->setJSON([
                    'success' => false,
                    'errors'  => $captchaError,
                ] + $this->csrfPayload());
            }

            return redirect()->back()->withInput()->with('errors', $captchaError);
        }

        $email = strtolower(trim((string) $this->request->getPost('email')));
        $subscribeModel = new SubscribeModel();

        $existing = $subscribeModel->where('email', $email)->first();
        if ($existing !== null) {
            if ($isAjax) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'This email is already subscribed.',
                ] + $this->csrfPayload());
            }

            return redirect()->back()->with('success', 'This email is already subscribed.');
        }

        $subscribeData = [
            'email'      => $email,
            'ip_address' => (string) $this->request->getIPAddress(),
            'user_agent' => substr((string) $this->request->getUserAgent(), 0, 255),
            'email_sent' => 0,
        ];

        $insertId = $subscribeModel->insert($subscribeData, true);

        if ($insertId === false) {
            $dbErrors = $subscribeModel->errors() ?: ['database' => 'We could not save your subscription. Please try again.'];

            if ($isAjax) {
                return $this->response->setStatusCode(500)->setJSON([
                    'success' => false,
                    'errors'  => $dbErrors,
                ] + $this->csrfPayload());
            }

            return redirect()->back()->withInput()->with('errors', $dbErrors);
        }

        $emailSent = $this->sendSubscribeNotification($subscribeData);

        if ($emailSent) {
            $subscribeModel->update($insertId, ['email_sent' => 1]);
        }

        $successMessage  = 'Thank you. You have been subscribed successfully.';
        $warningMessage  = 'Subscription saved, but admin email notification could not be sent.';
        $responseMessage = $emailSent ? $successMessage : $warningMessage;

        if ($isAjax) {
            return $this->response->setJSON([
                'success' => true,
                'message' => $responseMessage,
            ] + $this->csrfPayload());
        }

        if ($emailSent) {
            return redirect()->back()->with('success', $successMessage);
        }

        return redirect()->back()->with('warning', $warningMessage);
    }

    public function login()
    {
        return view('User/login');
    }

    public function register()
    {
        return view('User/register');
    }

    private function getRecaptchaSiteKey(): string
    {
        return trim((string) env('recaptcha.siteKey', ''));
    }

    private function getRecaptchaSecretKey(): string
    {
        return trim((string) env('recaptcha.secretKey', ''));
    }

    private function isRecaptchaConfigured(): bool
    {
        return $this->getRecaptchaSiteKey() !== '' && $this->getRecaptchaSecretKey() !== '';
    }

    private function csrfPayload(): array
    {
        return [
            'csrf' => csrf_hash(),
        ];
    }

    private function verifyRecaptchaToken(string $token, string $expectedAction = self::RECAPTCHA_V3_ACTION): bool
    {
        try {
            $response = Services::curlrequest()->post('https://www.google.com/recaptcha/api/siteverify', [
                'form_params' => [
                    'secret'   => $this->getRecaptchaSecretKey(),
                    'response' => $token,
                    'remoteip' => $this->request->getIPAddress(),
                ],
            ]);

            $payload = json_decode($response->getBody(), true);
            if (! is_array($payload) || empty($payload['success'])) {
                return false;
            }

            $version = strtolower(trim((string) env('recaptcha.version', 'v3')));

            if ($version === 'v3') {
                $action    = (string) ($payload['action'] ?? '');
                $score     = (float) ($payload['score'] ?? 0);
                $threshold = (float) env('recaptcha.v3Threshold', 0.5);

                return $action === $expectedAction && $score >= $threshold;
            }

            return true;
        } catch (\Throwable $exception) {
            log_message('error', 'reCAPTCHA verification failed: {message}', ['message' => $exception->getMessage()]);

            return false;
        }
    }

    private function sendContactNotification(array $contactData): bool
    {
        try {
            $email = Services::email();

            $emailConfig = config('Email');
            $fromEmail = $emailConfig->fromEmail !== '' ? $emailConfig->fromEmail : 'no-reply@theitupdates.com';
            $fromName = $emailConfig->fromName !== '' ? $emailConfig->fromName : 'TheITUpdates';

            $email->setFrom($fromEmail, $fromName);
            $email->setTo((string) env('contact.adminEmail', self::DEFAULT_CONTACT_ADMIN_EMAIL));
            $email->setReplyTo($contactData['email'], $contactData['name']);
            $email->setSubject('New Contact Us Inquiry from ' . $contactData['name']);
            $email->setMessage(view('User/email/contact-notification', [
                'contact' => $contactData,
                'submittedAt' => date('d M Y, h:i A'),
            ]));

            $sent = $email->send();
            if (! $sent) {
                log_message('error', 'Contact notification email failed: {debug}', [
                    'debug' => strip_tags($email->printDebugger([])),
                ]);
            }

            return $sent;
        } catch (\Throwable $exception) {
            log_message('error', 'Contact notification email failed: {message}', ['message' => $exception->getMessage()]);

            return false;
        }
    }

    private function sendPublishNotification(array $publishData): bool
    {
        try {
            $email = Services::email();

            $emailConfig = config('Email');
            $fromEmail   = $emailConfig->fromEmail !== '' ? $emailConfig->fromEmail : 'no-reply@theitupdates.com';
            $fromName    = $emailConfig->fromName !== '' ? $emailConfig->fromName : 'TheITUpdates';

            $email->setFrom($fromEmail, $fromName);
            $email->setTo((string) env('contact.adminEmail', self::DEFAULT_CONTACT_ADMIN_EMAIL));
            $email->setReplyTo($publishData['email'], $publishData['first_name'] . ' ' . $publishData['last_name']);
            $email->setSubject('New Whitepaper Submission from ' . $publishData['first_name'] . ' ' . $publishData['last_name']);
            $email->setMessage(view('User/email/publish-notification', [
                'publish'     => $publishData,
                'submittedAt' => date('d M Y, h:i A'),
            ]));

            $sent = $email->send();
            if (! $sent) {
                log_message('error', 'Publish notification email failed: {debug}', [
                    'debug' => strip_tags($email->printDebugger([])),
                ]);
            }

            return $sent;
        } catch (\Throwable $exception) {
            log_message('error', 'Publish notification email failed: {message}', ['message' => $exception->getMessage()]);

            return false;
        }
    }

    private function sendSubscribeNotification(array $subscribeData): bool
    {
        try {
            $email = Services::email();

            $emailConfig = config('Email');
            $fromEmail   = $emailConfig->fromEmail !== '' ? $emailConfig->fromEmail : 'no-reply@theitupdates.com';
            $fromName    = $emailConfig->fromName !== '' ? $emailConfig->fromName : 'TheITUpdates';

            $email->setFrom($fromEmail, $fromName);
            $email->setTo((string) env('contact.adminEmail', self::DEFAULT_CONTACT_ADMIN_EMAIL));
            $email->setReplyTo($subscribeData['email'], $subscribeData['email']);
            $email->setSubject('New Newsletter Subscription: ' . $subscribeData['email']);
            $email->setMessage(view('User/email/subscribe-notification', [
                'subscription' => $subscribeData,
                'submittedAt'  => date('d M Y, h:i A'),
            ]));

            $sent = $email->send();
            if (! $sent) {
                log_message('error', 'Subscribe notification email failed: {debug}', [
                    'debug' => strip_tags($email->printDebugger([])),
                ]);
            }

            return $sent;
        } catch (\Throwable $exception) {
            log_message('error', 'Subscribe notification email failed: {message}', ['message' => $exception->getMessage()]);

            return false;
        }
    }
}
