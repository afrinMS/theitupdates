<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use Config\Services;
use Throwable;

class AdminController extends BaseController
{
    public function index()
    {
        if (session()->get('admin_logged_in')) {
            return redirect()->to('/admin/dashboard');
        }
        return redirect()->to('/admin');
    }

    public function login()
    {
        if (session()->get('admin_logged_in')) {
            return redirect()->to('/admin/dashboard');
        }

        return view('Admin/login');
    }

    public function attemptLogin()
    {
        // Rate limiting: max 10 attempts per minute per IP
        $throttler = \Config\Services::throttler();
        if ($throttler->check(md5('admin_login_' . $this->request->getIPAddress()), 10, MINUTE) === false) {
            return redirect()->back()->with('error', 'Too many login attempts. Please wait before trying again.');
        }

        // reCAPTCHA v3 verification
        if (! $this->verifyAdminCaptcha((string) $this->request->getPost('g-recaptcha-response'))) {
            return redirect()->back()->withInput()->with('error', 'Security verification failed. Please try again.');
        }

        $validation = \Config\Services::validation();

        $rules = [
            'email'    => 'required|valid_email',
            'password' => 'required|min_length[6]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $adminModel = new AdminModel();
        $email      = strtolower((string) $this->request->getPost('email'));
        $admin      = $adminModel->where('email', $email)->first();

        // Check account lockout
        if ($admin && ! empty($admin['locked_until']) && strtotime($admin['locked_until']) > time()) {
            $minutes = (int) ceil((strtotime($admin['locked_until']) - time()) / 60);
            return redirect()->back()->withInput()->with('error', "Account locked due to too many failed attempts. Try again in {$minutes} minute(s).");
        }

        if (! $admin || ! password_verify($this->request->getPost('password'), $admin['password'])) {
            // Increment failed attempts; lock after 5 failures for 15 minutes
            if ($admin) {
                $attempts     = (int) ($admin['login_attempts'] ?? 0) + 1;
                $lockedUntil  = $attempts >= 5 ? date('Y-m-d H:i:s', time() + 15 * 60) : null;
                $adminModel->update($admin['id'], [
                    'login_attempts' => $attempts,
                    'locked_until'   => $lockedUntil,
                ]);
            }
            log_message('warning', '[Admin Login] Failed attempt for: ' . $email . ' | IP: ' . $this->request->getIPAddress());
            return redirect()->back()->withInput()->with('error', 'Invalid email or password.');
        }

        // Successful login – reset attempts, regenerate session (prevents session fixation)
        $adminModel->update($admin['id'], ['login_attempts' => 0, 'locked_until' => null]);
        session()->regenerate(true);

        session()->set([
            'admin_id'        => $admin['id'],
            'admin_name'      => $admin['name'],
            'admin_email'     => $admin['email'],
            'admin_logged_in' => true,
        ]);

        log_message('notice', '[Admin Login] Successful login for: ' . $email . ' | IP: ' . $this->request->getIPAddress());
        return redirect()->to('/admin/dashboard');
    }

    private function verifyAdminCaptcha(string $token): bool
    {
        $secretKey = trim((string) env('recaptcha.secretKey', ''));
        if ($secretKey === '') {
            return true; // reCAPTCHA not configured — allow through
        }

        try {
            $response = Services::curlrequest()->post('https://www.google.com/recaptcha/api/siteverify', [
                'form_params' => [
                    'secret'   => $secretKey,
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
                $score     = (float) ($payload['score'] ?? 0);
                $threshold = (float) env('recaptcha.v3Threshold', 0.5);
                return $score >= $threshold;
            }

            return true;
        } catch (Throwable $e) {
            log_message('error', 'Admin reCAPTCHA verification error: {message}', ['message' => $e->getMessage()]);
            return false;
        }
    }

    public function dashboard()
    {
        $db = db_connect();

        $safeCount = function (string $table) use ($db): int {
            try { return (int) $db->table($table)->countAllResults(); } catch (Throwable $e) { return 0; }
        };
        $safeQuery = function (callable $fn): array {
            try { return $fn(); } catch (Throwable $e) { return []; }
        };

        $stats = [
            'total_users'        => $safeCount('users'),
            'total_whitepapers'  => $safeCount('books'),
            'total_subscribers'  => $safeCount('subscribe'),
            'total_categories'   => $safeCount('categories'),
            'total_dnc'          => $safeCount('dnc'),
            'total_partnering'   => $safeCount('partnering'),
            'total_downloads'    => $safeCount('downloaded'),
            'total_direct'       => $safeCount('tbl_uploads'),

            'recent_users' => $safeQuery(function () use ($db) {
                return $db->table('users')
                    ->select('name, email, company, created_at')
                    ->orderBy('created_at', 'DESC')
                    ->limit(5)
                    ->get()->getResultArray();
            }),

            'recent_whitepapers' => $safeQuery(function () use ($db) {
                return $db->table('books')
                    ->select('name, type, date')
                    ->orderBy('book_id', 'DESC')
                    ->limit(5)
                    ->get()->getResultArray();
            }),

            'recent_downloads' => $safeQuery(function () use ($db) {
                return $db->table('downloaded d')
                    ->select('d.id, b.name AS book_name, d.name, d.email_id, d.comp')
                    ->join('books b', 'b.book_id = d.book_id', 'left')
                    ->orderBy('d.id', 'DESC')
                    ->limit(5)
                    ->get()->getResultArray();
            }),

            'recent_direct' => $safeQuery(function () use ($db) {
                return $db->table('tbl_uploads')
                    ->select('id, img_title, CampaignId, date')
                    ->orderBy('id', 'DESC')
                    ->limit(5)
                    ->get()->getResultArray();
            }),
        ];

        return view('Admin/dashboard', ['stats' => $stats]);
    }

    public function whitepapers()
    {
        $categories = [];

        try {
            $categories = db_connect()
                ->table('categories')
                ->select('c_id, category_name')
                ->where('category_name !=', 'Current Media')
                ->orderBy('category_name', 'ASC')
                ->get()
                ->getResultArray();
        } catch (Throwable $exception) {
            $categories = [];
        }

        return view('Admin/whitepapers', [
            'categories' => $categories,
        ]);
    }

    public function storeWhitepaper()
    {
        if (! $this->request->isAJAX()) {
            return $this->response->setStatusCode(405)->setJSON([
                'success' => false,
                'message' => 'Method not allowed.',
            ] + $this->csrfPayload());
        }

        $rules = [
            'name'          => ['required', 'min_length[3]', 'max_length[255]'],
            'desc'          => ['permit_empty', 'min_length[10]', 'max_length[5000]'],
            'category_id'   => ['required', 'integer'],
            'keyword'       => ['permit_empty', 'min_length[2]', 'max_length[255]'],
            'author'        => ['permit_empty', 'min_length[2]', 'max_length[255]'],
            'company'       => ['permit_empty', 'min_length[2]', 'max_length[255]'],
            'type'          => ['required', 'in_list[Visible To All,Visible To Yourself]'],
            'europe'        => ['required', 'in_list[Europe,non-Europe]'],
            'google'        => ['required', 'in_list[Yes,No]'],
            'resource_type' => ['required', 'in_list[Url,Download]'],
            'custom_type'   => ['required', 'in_list[none,options,text]'],
            'image'         => [
                'uploaded[image]',
                'is_image[image]',
                'mime_in[image,image/jpg,image/jpeg,image/png,image/gif,image/webp]',
                'max_size[image,5120]',
            ],
        ];

        $messages = [
            'name' => [
                'required'   => 'Please enter the whitepaper name.',
                'min_length' => 'The whitepaper name must be at least 3 characters.',
            ],
            'desc' => [
                'required'   => 'Please enter a description.',
                'min_length' => 'The description must be at least 10 characters.',
            ],
            'category_id' => [
                'required' => 'Please select a category.',
                'integer'  => 'Please select a valid category.',
            ],
            'keyword' => [
                'required'   => 'Please enter keywords.',
                'min_length' => 'Keywords must be at least 2 characters.',
            ],
            'author' => [
                'required'   => 'Please enter the author name.',
                'min_length' => 'The author name must be at least 2 characters.',
            ],
            'company' => [
                'required'   => 'Please enter the company name.',
                'min_length' => 'The company name must be at least 2 characters.',
            ],
            'type' => [
                'required' => 'Please choose the visibility type.',
                'in_list'  => 'Please choose a valid visibility type.',
            ],
            'europe' => [
                'required' => 'Please choose the target region.',
                'in_list'  => 'Please choose a valid target region.',
            ],
            'google' => [
                'required' => 'Please choose the Google Search option.',
                'in_list'  => 'Please choose a valid Google Search option.',
            ],
            'resource_type' => [
                'required' => 'Please choose how the whitepaper will be shared.',
                'in_list'  => 'Please choose a valid whitepaper delivery option.',
            ],
            'custom_type' => [
                'required' => 'Please choose the custom question type.',
                'in_list'  => 'Please choose a valid custom question type.',
            ],
            'image' => [
                'uploaded' => 'Please upload a cover image.',
                'is_image' => 'The cover image must be a valid image file.',
                'mime_in'  => 'The cover image must be a JPG, PNG, GIF, or WEBP file.',
                'max_size' => 'The cover image must be smaller than 5 MB.',
            ],
        ];

        if (! $this->validate($rules, $messages)) {
            return $this->response->setStatusCode(422)->setJSON([
                'success' => false,
                'errors'  => $this->validator->getErrors(),
            ] + $this->csrfPayload());
        }

        $db = db_connect();
        $category = $db->table('categories')
            ->select('c_id, category_name')
            ->where('c_id', (int) $this->request->getPost('category_id'))
            ->get()
            ->getRowArray();

        if ($category === null) {
            return $this->response->setStatusCode(422)->setJSON([
                'success' => false,
                'errors'  => ['category_id' => 'The selected category does not exist.'],
            ] + $this->csrfPayload());
        }

        $resourceType = (string) $this->request->getPost('resource_type');
        $customType   = (string) $this->request->getPost('custom_type');
        $resourceUrl  = trim((string) $this->request->getPost('resource_url'));
        $pdfFile      = $this->request->getFile('file_pdf');

        $conditionalErrors = [];

        if ($resourceType === 'Url') {
            if ($resourceUrl === '') {
                $conditionalErrors['resource_url'] = 'Please enter the whitepaper URL.';
            } elseif (filter_var($resourceUrl, FILTER_VALIDATE_URL) === false) {
                $conditionalErrors['resource_url'] = 'Please enter a valid URL starting with http:// or https://.';
            }
        }

        if ($resourceType === 'Download') {
            if ($pdfFile === null || ! $pdfFile->isValid()) {
                $conditionalErrors['file_pdf'] = 'Please upload the whitepaper PDF.';
            } else {
                $pdfValidation = \Config\Services::validation();
                $pdfValidation->setRules([
                    'file_pdf' => [
                        'uploaded[file_pdf]',
                        'ext_in[file_pdf,pdf]',
                        'mime_in[file_pdf,application/pdf,application/x-pdf]',
                        'max_size[file_pdf,15360]',
                    ],
                ], [
                    'file_pdf' => [
                        'uploaded' => 'Please upload the whitepaper PDF.',
                        'ext_in'   => 'Only PDF files are allowed.',
                        'mime_in'  => 'The uploaded file must be a valid PDF.',
                        'max_size' => 'The PDF must be smaller than 15 MB.',
                    ],
                ]);

                if (! $pdfValidation->withRequest($this->request)->run()) {
                    $conditionalErrors['file_pdf'] = $pdfValidation->getError('file_pdf');
                }
            }
        }

        [$optionQuestions, $optionQuestionError] = $this->collectOptionQuestions();
        [$textQuestions, $textQuestionError]     = $this->collectTextQuestions();

        if ($customType === 'options') {
            if ($optionQuestionError !== null) {
                $conditionalErrors['custom_questions'] = $optionQuestionError;
            } elseif ($optionQuestions === []) {
                $conditionalErrors['custom_questions'] = 'Please provide at least one custom question with at least two options.';
            }
        }

        if ($customType === 'text') {
            if ($textQuestionError !== null) {
                $conditionalErrors['custom_questions'] = $textQuestionError;
            } elseif ($textQuestions === []) {
                $conditionalErrors['custom_questions'] = 'Please provide at least one custom question for the text box option.';
            }
        }

        if ($conditionalErrors !== []) {
            return $this->response->setStatusCode(422)->setJSON([
                'success' => false,
                'errors'  => $conditionalErrors,
            ] + $this->csrfPayload());
        }

        $imagePath = null;
        $pdfPath   = null;
        $ipAddress = (string) $this->request->getIPAddress();
        $userAgent = (string) $this->request->getHeaderLine('User-Agent');
        $currentDateTime = date('Y-m-d H:i:s');

        try {
            $imagePath = $this->storeOptimizedImage($this->request->getFile('image'));

            if ($resourceType === 'Download' && $pdfFile !== null && $pdfFile->isValid()) {
                $pdfPath = $this->storePdfFile($pdfFile);
            }

            $customQuestionState = $customType === 'options' ? 'yes' : ($customType === 'text' ? 'yes_t' : 'no');
            $bookData = [
                'c_id'           => (int) $category['c_id'],
                'user_id'        => (int) session()->get('admin_id'),
                'name'           => $this->cleanInput((string) $this->request->getPost('name')),
                'description'    => $this->cleanInput((string) $this->request->getPost('desc')),
                'subject_area'   => $category['category_name'],
                'keywords'       => $this->cleanInput((string) $this->request->getPost('keyword')),
                'author'         => $this->cleanInput((string) $this->request->getPost('author')),
                'company'        => $this->cleanInput((string) $this->request->getPost('company')),
                'type'           => (string) $this->request->getPost('type'),
                'europe'         => (string) $this->request->getPost('europe'),
                'google'         => (string) $this->request->getPost('google'),
                'url'            => $resourceType === 'Url' ? $resourceUrl : '',
                'file1'          => $resourceType === 'Download' ? ($pdfPath ?? '') : '',
                'image'          => $imagePath,
                'username'       => (string) session()->get('admin_name'),
                'ip_address'     => $ipAddress,
                'user_agent'     => mb_substr($userAgent, 0, 255),
                'date'           => $currentDateTime,
                'customquestion' => $customQuestionState,
            ];

            $db->transStart();
            $db->table('books')->insert($bookData);
            $bookId = $db->insertID();

            if ($customType === 'options') {
                foreach ($optionQuestions as $question) {
                    $db->table('tbl_questions')->insert([
                        'book_id'  => $bookId,
                        'user_id'  => (int) session()->get('admin_id'),
                        'Question' => $question['question'],
                        'Option1'  => $question['options'][0],
                        'Option2'  => $question['options'][1],
                        'Option3'  => $question['options'][2],
                        'Option4'  => $question['options'][3],
                        'Option5'  => $question['options'][4],
                        'Option6'  => $question['options'][5],
                        'ip_address' => $ipAddress,
                        'user_agent' => mb_substr($userAgent, 0, 255),
                        'created_at' => $currentDateTime,
                    ]);
                }
            }

            if ($customType === 'text') {
                foreach ($textQuestions as $question) {
                    $db->table('tbl_questions_text')->insert([
                        'book_id'  => $bookId,
                        'user_id'  => (int) session()->get('admin_id'),
                        'Question' => $question,
                        'ip_address' => $ipAddress,
                        'user_agent' => mb_substr($userAgent, 0, 255),
                        'created_at' => $currentDateTime,
                    ]);
                }
            }

            $db->transComplete();

            if (! $db->transStatus()) {
                throw new \RuntimeException('Could not save the whitepaper right now.');
            }
        } catch (Throwable $exception) {
            $this->removeUploadedFile($imagePath, 'images/books/images');
            $this->removeUploadedFile($pdfPath, 'images/books/pdf');

            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'errors'  => [
                    'database' => 'Could not save the whitepaper right now. Please try again.',
                ],
            ] + $this->csrfPayload());
        }

        log_message('notice', '[Whitepaper Create] Saved by Admin ID: ' . session()->get('admin_id') . ' | Title: "' . $this->cleanInput((string) $this->request->getPost('name')) . '" | IP: ' . $this->request->getIPAddress());

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Whitepaper saved successfully.',
        ] + $this->csrfPayload());
    }

    public function listWhitepapers()
    {
        if (! $this->request->isAJAX()) {
            return $this->response->setStatusCode(405)->setJSON([
                'success' => false,
                'message' => 'Method not allowed.',
            ] + $this->csrfPayload());
        }

        $page    = max(1, (int) $this->request->getGet('page'));
        $perPage = (int) $this->request->getGet('per_page');
        $search  = trim((string) $this->request->getGet('search'));

        if (! in_array($perPage, [10, 25, 50], true)) {
            $perPage = 10;
        }


        $db = db_connect();
        $offset = ($page - 1) * $perPage;

        // Sorting logic
        $sortField = $this->request->getGet('sort_field') ?: 'book_id';
        $sortDir   = strtolower($this->request->getGet('sort_dir')) === 'asc' ? 'ASC' : 'DESC';
        $sortFieldMap = [
            'book_id'      => 'books.book_id',
            'name'         => 'books.name',
            'subject_area' => 'categories.category_name',
            'date'         => 'books.date',
        ];
        if (! array_key_exists($sortField, $sortFieldMap)) {
            $sortField = 'book_id';
        }
        if (! in_array($sortDir, ['ASC', 'DESC'], true)) {
            $sortDir = 'DESC';
        }

        $countBuilder = $db->table('books')
            ->join('categories', 'categories.c_id = books.c_id', 'left');
        $listBuilder  = $db->table('books')
            ->join('categories', 'categories.c_id = books.c_id', 'left');

        if ($search !== '') {
            $this->applyWhitepaperSearch($countBuilder, $search);
            $this->applyWhitepaperSearch($listBuilder, $search);
        }

        $total = (int) (clone $countBuilder)->countAllResults();

        $rows = $listBuilder
            ->select("books.book_id, books.c_id, books.name, books.subject_area, categories.category_name, COALESCE(NULLIF(books.subject_area, ''), categories.category_name) AS subject_area_display, books.author, books.company, books.type, books.europe, books.google, books.customquestion, books.image, books.file1, books.url, books.username, books.date")
            ->orderBy($sortFieldMap[$sortField], $sortDir)
            ->limit($perPage, $offset)
            ->get()
            ->getResultArray();

        $items = array_map(function (array $row): array {
            $row['image_url'] = $this->buildPublicAssetUrl($row['image'] ?? '', 'images/books/images');
            $row['pdf_url']   = $this->buildPublicAssetUrl($row['file1'] ?? '', 'images/books/pdf');

            return $row;
        }, $rows);

        return $this->response->setJSON([
            'success' => true,
            'data' => [
                'items' => $items,
                'pagination' => [
                    'page'      => $page,
                    'per_page'  => $perPage,
                    'total'     => $total,
                    'last_page' => max(1, (int) ceil($total / $perPage)),
                ],
            ],
        ] + $this->csrfPayload());
    }

    public function whitepaperDetail(int $bookId)
    {
        if (! $this->request->isAJAX()) {
            return $this->response->setStatusCode(405)->setJSON([
                'success' => false,
                'message' => 'Method not allowed.',
            ] + $this->csrfPayload());
        }

        $db = db_connect();
        $book = $db->table('books')
            ->select('book_id, c_id, user_id, name, description, subject_area, keywords, author, company, type, europe, google, url, file1, image, username, date, customquestion, ip_address, user_agent')
            ->where('book_id', $bookId)
            ->get()
            ->getRowArray();

        if ($book === null) {
            return $this->response->setStatusCode(404)->setJSON([
                'success' => false,
                'errors'  => ['database' => 'Whitepaper not found.'],
            ] + $this->csrfPayload());
        }

        $optionQuestions = $db->table('tbl_questions')
            ->select('Question, Option1, Option2, Option3, Option4, Option5, Option6')
            ->where('book_id', $bookId)
            ->orderBy('Qid', 'ASC')
            ->get()
            ->getResultArray();

        $textQuestions = $db->table('tbl_questions_text')
            ->select('Question')
            ->where('book_id', $bookId)
            ->orderBy('Qid', 'ASC')
            ->get()
            ->getResultArray();

        $book['resource_type'] = ($book['url'] ?? '') !== '' ? 'Url' : 'Download';
        $book['custom_type']   = ($book['customquestion'] ?? 'no') === 'yes' ? 'options' : ((($book['customquestion'] ?? 'no') === 'yes_t') ? 'text' : 'none');
        $book['image_url']     = $this->buildPublicAssetUrl($book['image'] ?? '', 'images/books/images');
        $book['pdf_url']       = $this->buildPublicAssetUrl($book['file1'] ?? '', 'images/books/pdf');

        return $this->response->setJSON([
            'success' => true,
            'data' => [
                'book'             => $book,
                'option_questions' => $optionQuestions,
                'text_questions'   => $textQuestions,
            ],
        ] + $this->csrfPayload());
    }

    public function updateWhitepaper(int $bookId)
    {
        if (! $this->request->isAJAX()) {
            return $this->response->setStatusCode(405)->setJSON([
                'success' => false,
                'message' => 'Method not allowed.',
            ] + $this->csrfPayload());
        }

        $db = db_connect();
        $existing = $db->table('books')->where('book_id', $bookId)->get()->getRowArray();

        if ($existing === null) {
            return $this->response->setStatusCode(404)->setJSON([
                'success' => false,
                'errors'  => ['database' => 'Whitepaper not found.'],
            ] + $this->csrfPayload());
        }

        $rules = [
            'name'          => ['required', 'min_length[3]', 'max_length[255]'],
            'desc'          => ['permit_empty', 'min_length[10]', 'max_length[5000]'],
            'category_id'   => ['required', 'integer'],
            'keyword'       => ['permit_empty', 'min_length[2]', 'max_length[255]'],
            'author'        => ['permit_empty', 'min_length[2]', 'max_length[255]'],
            'company'       => ['permit_empty', 'min_length[2]', 'max_length[255]'],
            'type'          => ['required', 'in_list[Visible To All,Visible To Yourself]'],
            'europe'        => ['required', 'in_list[Europe,non-Europe]'],
            'google'        => ['required', 'in_list[Yes,No]'],
            'resource_type' => ['required', 'in_list[Url,Download]'],
            'custom_type'   => ['required', 'in_list[none,options,text]'],
        ];

        if (! $this->validate($rules)) {
            return $this->response->setStatusCode(422)->setJSON([
                'success' => false,
                'errors'  => $this->validator->getErrors(),
            ] + $this->csrfPayload());
        }

        $category = $db->table('categories')
            ->select('c_id, category_name')
            ->where('c_id', (int) $this->request->getPost('category_id'))
            ->get()
            ->getRowArray();

        if ($category === null) {
            return $this->response->setStatusCode(422)->setJSON([
                'success' => false,
                'errors'  => ['category_id' => 'The selected category does not exist.'],
            ] + $this->csrfPayload());
        }

        $resourceType = (string) $this->request->getPost('resource_type');
        $customType   = (string) $this->request->getPost('custom_type');
        $resourceUrl  = trim((string) $this->request->getPost('resource_url'));
        $pdfFile      = $this->request->getFile('file_pdf');
        $imageFile    = $this->request->getFile('image');
        $ipAddress    = (string) $this->request->getIPAddress();
        $userAgent    = (string) $this->request->getHeaderLine('User-Agent');
        $currentDateTime = date('Y-m-d H:i:s');

        $hasPdfUpload = $pdfFile !== null && $pdfFile->isValid() && $pdfFile->getClientName() !== '';
        $hasImageUpload = $imageFile !== null && $imageFile->isValid() && $imageFile->getClientName() !== '';

        $conditionalErrors = [];

        if ($resourceType === 'Url') {
            if ($resourceUrl === '') {
                $conditionalErrors['resource_url'] = 'Please enter the whitepaper URL.';
            } elseif (filter_var($resourceUrl, FILTER_VALIDATE_URL) === false) {
                $conditionalErrors['resource_url'] = 'Please enter a valid URL starting with http:// or https://.';
            }
        }

        if ($resourceType === 'Download') {
            $existingPdf = (string) ($existing['file1'] ?? '');
            if (! $hasPdfUpload && $existingPdf === '') {
                $conditionalErrors['file_pdf'] = 'Please upload the whitepaper PDF.';
            }

            if ($hasPdfUpload) {
                $pdfValidation = Services::validation();
                $pdfValidation->setRules([
                    'file_pdf' => [
                        'uploaded[file_pdf]',
                        'ext_in[file_pdf,pdf]',
                        'mime_in[file_pdf,application/pdf,application/x-pdf]',
                        'max_size[file_pdf,15360]',
                    ],
                ]);

                if (! $pdfValidation->withRequest($this->request)->run()) {
                    $conditionalErrors['file_pdf'] = $pdfValidation->getError('file_pdf');
                }
            }
        }

        if ($hasImageUpload) {
            $imageValidation = Services::validation();
            $imageValidation->setRules([
                'image' => [
                    'uploaded[image]',
                    'is_image[image]',
                    'mime_in[image,image/jpg,image/jpeg,image/png,image/gif,image/webp]',
                    'max_size[image,5120]',
                ],
            ]);

            if (! $imageValidation->withRequest($this->request)->run()) {
                $conditionalErrors['image'] = $imageValidation->getError('image');
            }
        }

        [$optionQuestions, $optionQuestionError] = $this->collectOptionQuestions();
        [$textQuestions, $textQuestionError]     = $this->collectTextQuestions();

        if ($customType === 'options') {
            if ($optionQuestionError !== null) {
                $conditionalErrors['custom_questions'] = $optionQuestionError;
            } elseif ($optionQuestions === []) {
                $conditionalErrors['custom_questions'] = 'Please provide at least one custom question with at least two options.';
            }
        }

        if ($customType === 'text') {
            if ($textQuestionError !== null) {
                $conditionalErrors['custom_questions'] = $textQuestionError;
            } elseif ($textQuestions === []) {
                $conditionalErrors['custom_questions'] = 'Please provide at least one custom question for the text box option.';
            }
        }

        if ($conditionalErrors !== []) {
            return $this->response->setStatusCode(422)->setJSON([
                'success' => false,
                'errors'  => $conditionalErrors,
            ] + $this->csrfPayload());
        }

        $newImageName = null;
        $newPdfName   = null;

        try {
            if ($hasImageUpload) {
                $newImageName = $this->storeOptimizedImage($imageFile);
            }

            if ($resourceType === 'Download' && $hasPdfUpload) {
                $newPdfName = $this->storePdfFile($pdfFile);
            }

            $updateData = [
                'c_id'         => (int) $category['c_id'],
                'name'         => $this->cleanInput((string) $this->request->getPost('name')),
                'description'  => $this->cleanInput((string) $this->request->getPost('desc')),
                'subject_area' => $category['category_name'],
                'keywords'     => $this->cleanInput((string) $this->request->getPost('keyword')),
                'author'       => $this->cleanInput((string) $this->request->getPost('author')),
                'company'      => $this->cleanInput((string) $this->request->getPost('company')),
                'type'         => (string) $this->request->getPost('type'),
                'europe'       => (string) $this->request->getPost('europe'),
                'google'       => (string) $this->request->getPost('google'),
                'ip_address'   => $ipAddress,
                'user_agent'   => mb_substr($userAgent, 0, 255),
                'date'         => $currentDateTime,
                'customquestion' => $customType === 'options' ? 'yes' : ($customType === 'text' ? 'yes_t' : 'no'),
            ];

            if ($resourceType === 'Url') {
                $updateData['url'] = $resourceUrl;
                $updateData['file1'] = '';
            } else {
                $updateData['url'] = '';
                if ($newPdfName !== null) {
                    $updateData['file1'] = $newPdfName;
                }
            }

            if ($newImageName !== null) {
                $updateData['image'] = $newImageName;
            }

            $db->transStart();
            $db->table('books')->where('book_id', $bookId)->update($updateData);
            $db->table('tbl_questions')->where('book_id', $bookId)->delete();
            $db->table('tbl_questions_text')->where('book_id', $bookId)->delete();

            if ($customType === 'options') {
                foreach ($optionQuestions as $question) {
                    $db->table('tbl_questions')->insert([
                        'book_id'    => $bookId,
                        'user_id'    => (int) session()->get('admin_id'),
                        'Question'   => $question['question'],
                        'Option1'    => $question['options'][0],
                        'Option2'    => $question['options'][1],
                        'Option3'    => $question['options'][2],
                        'Option4'    => $question['options'][3],
                        'Option5'    => $question['options'][4],
                        'Option6'    => $question['options'][5],
                        'ip_address' => $ipAddress,
                        'user_agent' => mb_substr($userAgent, 0, 255),
                        'created_at' => $currentDateTime,
                    ]);
                }
            }

            if ($customType === 'text') {
                foreach ($textQuestions as $question) {
                    $db->table('tbl_questions_text')->insert([
                        'book_id'    => $bookId,
                        'user_id'    => (int) session()->get('admin_id'),
                        'Question'   => $question,
                        'ip_address' => $ipAddress,
                        'user_agent' => mb_substr($userAgent, 0, 255),
                        'created_at' => $currentDateTime,
                    ]);
                }
            }

            $db->transComplete();

            if (! $db->transStatus()) {
                throw new \RuntimeException('Could not update the whitepaper right now. Please try again.');
            }

            if ($newImageName !== null && ! empty($existing['image'])) {
                $this->removeUploadedFile((string) $existing['image'], 'images/books/images');
            }

            if ($resourceType === 'Url' && ! empty($existing['file1'])) {
                $this->removeUploadedFile((string) $existing['file1'], 'images/books/pdf');
            }

            if ($newPdfName !== null && ! empty($existing['file1'])) {
                $this->removeUploadedFile((string) $existing['file1'], 'images/books/pdf');
            }
        } catch (Throwable $exception) {
            $this->removeUploadedFile($newImageName, 'images/books/images');
            $this->removeUploadedFile($newPdfName, 'images/books/pdf');

            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'errors'  => ['database' => 'Could not update the whitepaper right now. Please try again.'],
            ] + $this->csrfPayload());
        }

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Whitepaper updated successfully.',
        ] + $this->csrfPayload());
    }

    public function deleteWhitepaper(int $bookId)
    {
        if (! $this->request->isAJAX()) {
            return $this->response->setStatusCode(405)->setJSON([
                'success' => false,
                'message' => 'Method not allowed.',
            ] + $this->csrfPayload());
        }

        $db = db_connect();
        $book = $db->table('books')->where('book_id', $bookId)->get()->getRowArray();

        if ($book === null) {
            return $this->response->setStatusCode(404)->setJSON([
                'success' => false,
                'errors'  => ['database' => 'Whitepaper not found.'],
            ] + $this->csrfPayload());
        }

        $db->transStart();
        $db->table('tbl_questions')->where('book_id', $bookId)->delete();
        $db->table('tbl_questions_text')->where('book_id', $bookId)->delete();
        $db->table('books')->where('book_id', $bookId)->delete();
        $db->transComplete();

        if (! $db->transStatus()) {
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'errors'  => ['database' => 'Could not delete the whitepaper right now. Please try again.'],
            ] + $this->csrfPayload());
        }

        $this->removeUploadedFile((string) ($book['image'] ?? ''), 'images/books/images');
        $this->removeUploadedFile((string) ($book['file1'] ?? ''), 'images/books/pdf');

        log_message('notice', '[Whitepaper Delete] Book ID: ' . $bookId . ' ("' . ($book['name'] ?? '') . '") deleted by Admin ID: ' . session()->get('admin_id') . ' | IP: ' . $this->request->getIPAddress());

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Whitepaper deleted successfully.',
        ] + $this->csrfPayload());
    }

    public function registeredUsers()
    {
        return view('Admin/registered_users');
    }

    public function subscribers()
    {
        return view('Admin/subscribers');
    }

    public function listSubscribers()
    {
        if (! $this->request->isAJAX()) {
            return $this->response->setStatusCode(405)->setBody('Method Not Allowed');
        }

        $db = db_connect();
        $page = max(1, (int) ($this->request->getGet('page') ?? 1));
        $perPage = (int) ($this->request->getGet('per_page') ?? 10);
        $perPage = in_array($perPage, [10, 25, 50, 100], true) ? $perPage : 10;
        $search = trim((string) ($this->request->getGet('search') ?? ''));
        $sort = (string) ($this->request->getGet('sort') ?? 'created_at');
        $order = strtoupper((string) ($this->request->getGet('order') ?? 'DESC'));

        $tableFields = array_flip($db->getFieldNames('subscribe'));
        $selectFields = ['id', 'email', 'ip_address', 'user_agent', 'email_sent', 'created_at'];

        if (isset($tableFields['user_id'])) {
            $selectFields[] = 'user_id';
        }

        if (isset($tableFields['updated_at'])) {
            $selectFields[] = 'updated_at';
        }

        $allowedSort = ['id', 'email', 'ip_address', 'email_sent', 'created_at'];
        if (isset($tableFields['user_id'])) {
            $allowedSort[] = 'user_id';
        }

        $sort = in_array($sort, $allowedSort, true) ? $sort : 'created_at';
        $order = in_array($order, ['ASC', 'DESC'], true) ? $order : 'DESC';

        $builder = $db->table('subscribe')
            ->select(implode(', ', $selectFields));

        if ($search !== '') {
            $builder->groupStart()->like('email', $search);

            if (isset($tableFields['ip_address'])) {
                $builder->orLike('ip_address', $search);
            }

            if (isset($tableFields['user_agent'])) {
                $builder->orLike('user_agent', $search);
            }

            $builder->groupEnd();
        }

        $total = (clone $builder)->countAllResults();
        $offset = ($page - 1) * $perPage;
        $rows = $builder->orderBy($sort, $order)
            ->limit($perPage, $offset)
            ->get()
            ->getResultArray();

        foreach ($rows as &$row) {
            if (! array_key_exists('user_id', $row)) {
                $row['user_id'] = null;
            }
            if (! array_key_exists('email_sent', $row)) {
                $row['email_sent'] = 0;
            }
            if (! array_key_exists('ip_address', $row)) {
                $row['ip_address'] = '';
            }
            if (! array_key_exists('user_agent', $row)) {
                $row['user_agent'] = '';
            }
        }
        unset($row);

        return $this->response->setJSON([
            'success' => true,
            'data' => $rows,
            'page' => $page,
            'per_page' => $perPage,
            'total' => $total,
            'total_pages' => (int) ceil($total / max(1, $perPage)),
            'csrf' => csrf_hash(),
        ]);
    }

    public function categories()
    {
        return view('Admin/categories');
    }

    public function iframe()
    {
        return view('Admin/iframe');
    }

    public function surveyLander()
    {
        return view('Admin/survey_lander');
    }

    public function surveyResponses()
    {
        return view('Admin/survey_responses');
    }

    public function direct()
    {
        return view('Admin/direct');
    }

    public function admins()
    {
        if (! $this->isSuperAdmin()) {
            return redirect()->to('/admin/dashboard')->with('error', 'Only Super Admin can access the Admins section.');
        }

        return view('Admin/admins');
    }

    public function dncUsers()
    {
        return view('Admin/dnc_users');
    }

    public function downloadedBooks()
    {
        return view('Admin/downloaded_books');
    }

    public function listDownloadedBooks()
    {
        if (! $this->request->isAJAX()) {
            return $this->response->setStatusCode(405)->setBody('Method Not Allowed');
        }

        $db      = db_connect();
        $page    = max(1, (int) ($this->request->getGet('page') ?? 1));
        $perPage = (int) ($this->request->getGet('per_page') ?? 10);
        $perPage = in_array($perPage, [10, 25, 50, 100], true) ? $perPage : 10;
        $search  = trim((string) ($this->request->getGet('search') ?? ''));
        $sort    = (string) ($this->request->getGet('sort') ?? 'id');
        $order   = strtoupper((string) ($this->request->getGet('order') ?? 'DESC'));

        $allowedSort  = ['id', 'book_name', 'name', 'email_id', 'job_title', 'comp'];
        $sort  = in_array($sort, $allowedSort, true) ? $sort : 'id';
        $order = in_array($order, ['ASC', 'DESC'], true) ? $order : 'DESC';

        $builder = $db->table('downloaded d')
            ->select('d.id, d.book_id, b.name AS book_name, d.name, d.email_id, d.job_title, d.comp, d.customquestion, d.answers, d.if_europe, d.if_noneurope')
            ->join('books b', 'b.book_id = d.book_id', 'left');

        if ($search !== '') {
            $builder->groupStart()
                ->like('d.name', $search)
                ->orLike('d.email_id', $search)
                ->orLike('d.job_title', $search)
                ->orLike('d.comp', $search)
                ->orLike('b.name', $search)
                ->groupEnd();
        }

        $total  = (clone $builder)->countAllResults();
        $offset = ($page - 1) * $perPage;
        $rows   = $builder->orderBy($sort, $order)->limit($perPage, $offset)->get()->getResultArray();

        return $this->response->setJSON([
            'success'     => true,
            'data'        => $rows,
            'page'        => $page,
            'per_page'    => $perPage,
            'total'       => $total,
            'total_pages' => (int) ceil($total / max(1, $perPage)),
            'csrf'        => csrf_hash(),
        ]);
    }

    public function partneringUsers()
    {
        return view('Admin/partnering_users');
    }

    public function listPartneringUsers()
    {
        if (! $this->request->isAJAX()) {
            return $this->response->setStatusCode(405)->setBody('Method Not Allowed');
        }

        $model  = new \App\Models\PartneringModel();
        $page    = (int) $this->request->getGet('page') ?: 1;
        $perPage = (int) $this->request->getGet('per_page') ?: 10;
        $search  = (string) $this->request->getGet('search') ?: '';
        $sort    = (string) $this->request->getGet('sort') ?: 'created_at';
        $order   = strtoupper((string) $this->request->getGet('order') ?: 'DESC');

        $allowedSortFields = ['id', 'name', 'email', 'company_name', 'job_title', 'industry', 'phone', 'country', 'created_at'];
        $sort  = in_array($sort, $allowedSortFields) ? $sort : 'created_at';
        $order = in_array($order, ['ASC', 'DESC']) ? $order : 'DESC';

        $query = $model;

        if ($search) {
            $query = $query->groupStart()
                           ->like('name', $search)
                           ->orLike('email', $search)
                           ->orLike('company_name', $search)
                           ->orLike('industry', $search)
                           ->orLike('country', $search)
                           ->groupEnd();
        }

        $total      = $query->countAllResults(false);
        $offset     = ($page - 1) * $perPage;
        $users      = $query->orderBy($sort, $order)->limit($perPage)->offset($offset)->findAll();
        $totalPages = (int) ceil($total / $perPage);

        return $this->response->setJSON([
            'success'     => true,
            'data'        => $users,
            'page'        => $page,
            'per_page'    => $perPage,
            'total'       => $total,
            'total_pages' => $totalPages,
        ]);
    }

    public function listDncUsers()
    {
        if (! $this->request->isAJAX()) {
            return $this->response->setStatusCode(405)->setBody('Method Not Allowed');
        }

        $dncModel = new \App\Models\DncModel();
        $page = (int) $this->request->getGet('page') ?: 1;
        $perPage = (int) $this->request->getGet('per_page') ?: 10;
        $search = (string) $this->request->getGet('search') ?: '';
        $sort = (string) $this->request->getGet('sort') ?: 'created_at';
        $order = strtoupper((string) $this->request->getGet('order') ?: 'DESC');

        // Validate sort field to prevent SQL injection
        $allowedSortFields = ['id', 'first_name', 'last_name', 'email', 'company_name', 'job_title', 'country', 'communication_opt_in', 'created_at'];
        $sort = in_array($sort, $allowedSortFields) ? $sort : 'created_at';
        $order = in_array($order, ['ASC', 'DESC']) ? $order : 'DESC';

        // Build query
        $query = $dncModel;

        if ($search) {
            $query = $query->groupStart()
                          ->where('CONCAT(first_name, " ", last_name) LIKE', "%{$search}%")
                          ->orWhere('email LIKE', "%{$search}%")
                          ->orWhere('company_name LIKE', "%{$search}%")
                          ->orWhere('job_title LIKE', "%{$search}%")
                          ->groupEnd();
        }

        // Get total count
        $total = (clone $query)->countAllResults();

        // Get paginated results
        $offset = ($page - 1) * $perPage;
        $users = $query->orderBy($sort, $order)
                      ->limit($perPage)
                      ->offset($offset)
                      ->findAll();

        $totalPages = ceil($total / $perPage);

        return $this->response->setJSON([
            'success' => true,
            'data'    => $users,
            'page'    => $page,
            'per_page' => $perPage,
            'total'   => $total,
            'total_pages' => $totalPages,
        ]);
    }

    public function logout()
    {
        log_message('notice', '[Admin Logout] Admin ID: ' . session()->get('admin_id') . ' (' . session()->get('admin_email') . ') logged out | IP: ' . $this->request->getIPAddress());
        session()->destroy();
        return redirect()->to('/admin');
    }

    private function csrfPayload(): array
    {
        return [
            'csrf' => csrf_hash(),
        ];
    }

    private function cleanInput(string $value): string
    {
        return strip_tags(trim($value));
    }

    private function isSuperAdmin(): bool
    {
        return (int) (session()->get('admin_id') ?? 0) === 1;
    }

    private function collectOptionQuestions(): array
    {
        $questionRows = $this->request->getPost('option_questions');
        $answerRows   = $this->request->getPost('option_answers');

        if (! is_array($questionRows)) {
            return [[], null];
        }

        $questions = [];

        foreach ($questionRows as $index => $questionText) {
            $questionText = $this->cleanInput((string) $questionText);
            $answers      = $answerRows[$index] ?? [];
            $answers      = is_array($answers) ? $answers : [];
            $answers      = array_values(array_filter(array_map(fn ($answer) => $this->cleanInput((string) $answer), $answers), static fn ($answer) => $answer !== ''));

            if ($questionText === '' && $answers === []) {
                continue;
            }

            if ($questionText === '') {
                return [[], 'Each custom question row with options must include a question.'];
            }

            if (count($answers) < 2) {
                return [[], 'Each custom question row must include at least two options.'];
            }

            $questions[] = [
                'question' => $questionText,
                'options'  => array_pad(array_slice($answers, 0, 6), 6, ''),
            ];
        }

        return [$questions, null];
    }

    private function collectTextQuestions(): array
    {
        $questionRows = $this->request->getPost('text_questions');

        if (! is_array($questionRows)) {
            return [[], null];
        }

        $questions = [];

        foreach ($questionRows as $questionText) {
            $questionText = $this->cleanInput((string) $questionText);

            if ($questionText === '') {
                continue;
            }

            $questions[] = $questionText;
        }

        return [$questions, null];
    }

    private function storeOptimizedImage($file): string
    {
        $directory = FCPATH . 'images/books/images/';

        if (! is_dir($directory) && ! mkdir($directory, 0775, true) && ! is_dir($directory)) {
            throw new \RuntimeException('Image upload directory is not writable.');
        }

        $targetName = $file->getRandomName();
        $targetPath = $directory . $targetName;

        try {
            Services::image()
                ->withFile($file->getTempName())
                ->resize(1600, 1600, true, 'height')
                ->save($targetPath, 80);
        } catch (Throwable $exception) {
            $file->move($directory, $targetName);
        }

        return $targetName;
    }

    private function storePdfFile($file): string
    {
        $directory = FCPATH . 'images/books/pdf/';

        if (! is_dir($directory) && ! mkdir($directory, 0775, true) && ! is_dir($directory)) {
            throw new \RuntimeException('PDF upload directory is not writable.');
        }

        $targetName = $file->getRandomName();
        $file->move($directory, $targetName);

        return $targetName;
    }

    private function removeUploadedFile(?string $relativePath, string $baseDirectory = ''): void
    {
        if ($relativePath === null || $relativePath === '') {
            return;
        }

        $hasDirectory = str_contains($relativePath, '/') || str_contains($relativePath, '\\');

        if ($hasDirectory) {
            $fullPath = FCPATH . str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $relativePath);
        } else {
            $prefix = trim(str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $baseDirectory), DIRECTORY_SEPARATOR);
            $fullPath = FCPATH . ($prefix !== '' ? $prefix . DIRECTORY_SEPARATOR : '') . $relativePath;
        }

        if (is_file($fullPath)) {
            @unlink($fullPath);
        }
    }

    private function applyWhitepaperSearch($builder, string $search): void
    {
        $builder
            ->groupStart()
            ->like('books.name', $search)
            ->orLike('books.subject_area', $search)
            ->orLike('categories.category_name', $search)
            ->orLike('books.author', $search)
            ->orLike('books.company', $search)
            ->orLike('books.keywords', $search)
            ->groupEnd();
    }

    private function buildPublicAssetUrl(?string $storedValue, string $baseDirectory): ?string
    {
        $value = trim((string) $storedValue);

        if ($value === '') {
            return null;
        }

        if (filter_var($value, FILTER_VALIDATE_URL) !== false) {
            return $value;
        }

        $normalized = str_replace('\\', '/', $value);
        if (str_contains($normalized, '/')) {
            return base_url(ltrim($normalized, '/'));
        }

        return base_url(trim($baseDirectory, '/') . '/' . $normalized);
    }
}
