<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\PasswordResetModel;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

class UserAuthController extends BaseController
{
    protected $userModel;
    protected $passwordResetModel;
    protected $recaptchaSecretKey;
    protected $recaptchaEnabled;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->passwordResetModel = new PasswordResetModel();
        $this->recaptchaSecretKey = trim((string) env('recaptcha.secretKey', ''));
        $this->recaptchaEnabled = $this->recaptchaSecretKey !== '' && trim((string) env('recaptcha.siteKey', '')) !== '';
    }

    public function register()
    {
        if (session()->get('user_logged_in')) {
            return redirect()->to(base_url('/'));
        }

        $data['recaptchaSiteKey'] = trim((string) env('recaptcha.siteKey', ''));
        $data['recaptchaEnabled'] = $this->recaptchaEnabled;

        return view('User/register', $data);
    }

    public function registerSubmit()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(403)->setJSON(['success' => false]);
        }

        if (session()->get('user_logged_in')) {
            return $this->response->setJSON(['success' => false, 'message' => 'Already logged in']);
        }

        if (!$this->validateCsrfAjax()) {
            return $this->response->setStatusCode(403)->setJSON(['success' => false, 'message' => 'Invalid security token']);
        }

        if (!$this->verifyCaptcha((string) $this->request->getPost('g-recaptcha-response'), 'register')) {
            return $this->response->setJSON(['success' => false, 'message' => 'Security verification failed']);
        }

        $rules = [
            'full_name' => 'required|string|min_length[2]|max_length[100]|regex_match[/^[a-zA-Z\s\-\'\.]+$/]',
            'email' => 'required|valid_email|is_unique[users.email]|max_length[255]',
            'password' => 'required|min_length[8]|max_length[255]',
            'confirm_password' => 'required|matches[password]',
            'job_title' => 'permit_empty|string|max_length[100]',
            'phone_number' => 'permit_empty|string|max_length[30]|regex_match[/^[\d\s\-\+\(\)]+$/]',
            'company' => 'permit_empty|string|max_length[255]',
            'optin' => 'required|in_list[0,1]',
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $this->validator->getErrors(),
                'csrf' => csrf_hash(),
            ]);
        }

        $data = [
            'name' => $this->request->getPost('full_name'),
            'email' => strtolower($this->request->getPost('email')),
            'password' => $this->request->getPost('password'),
            'job_title' => $this->request->getPost('job_title') ?: null,
            'phone_number' => $this->request->getPost('phone_number') ?: null,
            'company' => $this->request->getPost('company') ?: null,
            'optin'      => (int) $this->request->getPost('optin'),
            'ip_address' => (string) $this->request->getIPAddress(),
            'user_agent' => mb_substr((string) $this->request->getUserAgent(), 0, 255),
        ];

        if ($this->userModel->insert($data)) {
            log_message('notice', '[User Register] New account: ' . strtolower($this->request->getPost('email')) . ' | IP: ' . $this->request->getIPAddress());
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Account created successfully',
                'csrf' => csrf_hash(),
            ]);
        }

        return $this->response->setJSON([
            'success' => false,
            'message' => 'Registration failed. Please try again.',
            'csrf' => csrf_hash(),
        ]);
    }

    public function login()
    {
        if (session()->get('user_logged_in')) {
            return redirect()->to(base_url('/'));
        }

        $data['recaptchaSiteKey'] = trim((string) env('recaptcha.siteKey', ''));
        $data['recaptchaEnabled'] = $this->recaptchaEnabled;

        return view('User/login', $data);
    }

    public function loginSubmit()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(403)->setJSON(['success' => false]);
        }

        if (session()->get('user_logged_in')) {
            return $this->response->setJSON(['success' => false, 'message' => 'Already logged in']);
        }

        if (!$this->validateCsrfAjax()) {
            return $this->response->setStatusCode(403)->setJSON(['success' => false, 'message' => 'Invalid security token']);
        }

        // Rate limiting: max 10 attempts per minute per IP
        $throttler = \Config\Services::throttler();
        if ($throttler->check(md5('user_login_' . $this->request->getIPAddress()), 10, MINUTE) === false) {
            return $this->response->setStatusCode(429)->setJSON([
                'success' => false,
                'message' => 'Too many login attempts. Please wait before trying again.',
                'csrf'    => csrf_hash(),
            ]);
        }

        if (!$this->verifyCaptcha((string) $this->request->getPost('g-recaptcha-response'), 'login')) {
            return $this->response->setJSON(['success' => false, 'message' => 'Security verification failed']);
        }

        $rules = [
            'email'    => 'required|valid_email',
            'password' => 'required|string',
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Invalid input',
                'csrf'    => csrf_hash(),
            ]);
        }

        $email    = strtolower($this->request->getPost('email'));
        $password = $this->request->getPost('password');

        $user = $this->userModel->where('email', $email)->first();

        // Check account lockout
        if ($user && ! empty($user['locked_until']) && strtotime($user['locked_until']) > time()) {
            $minutes = (int) ceil((strtotime($user['locked_until']) - time()) / 60);
            return $this->response->setJSON([
                'success' => false,
                'message' => "Account locked due to too many failed attempts. Try again in {$minutes} minute(s).",
                'csrf'    => csrf_hash(),
            ]);
        }

        if (!$user || !password_verify($password, $user['password'])) {
            // Increment failed attempts; lock after 5 failures for 15 minutes
            if ($user) {
                $attempts    = (int) ($user['login_attempts'] ?? 0) + 1;
                $lockedUntil = $attempts >= 5 ? date('Y-m-d H:i:s', time() + 15 * 60) : null;
                $this->userModel->update($user['id'], [
                    'login_attempts' => $attempts,
                    'locked_until'   => $lockedUntil,
                ]);
            }
            log_message('warning', '[User Login] Failed attempt for: ' . $email . ' | IP: ' . $this->request->getIPAddress());
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Invalid email or password',
                'csrf'    => csrf_hash(),
            ]);
        }

        // Successful login – reset attempts, regenerate session (prevents session fixation)
        $this->userModel->update($user['id'], ['login_attempts' => 0, 'locked_until' => null]);
        session()->regenerate(true);

        session()->set([
            'user_id'        => $user['id'],
            'user_name'      => $user['name'],
            'user_email'     => $user['email'],
            'user_logged_in' => true,
        ]);

        log_message('notice', '[User Login] Successful login for: ' . $email . ' | IP: ' . $this->request->getIPAddress());
        return $this->response->setJSON([
            'success'  => true,
            'message'  => 'Logged in successfully',
            'redirect' => base_url('/'),
            'csrf'     => csrf_hash(),
        ]);
    }

    public function editProfile()
    {
        if (!session()->get('user_logged_in')) {
            return redirect()->to(base_url('login'));
        }

        $userId = session()->get('user_id');
        $user = $this->userModel->find($userId);

        if (!$user) {
            session()->destroy();
            return redirect()->to(base_url('login'));
        }

        $data['user'] = $user;

        return view('User/edit-profile', $data);
    }

    public function profileUpdate()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(403)->setJSON(['success' => false]);
        }

        if (!session()->get('user_logged_in')) {
            return $this->response->setStatusCode(403)->setJSON(['success' => false, 'message' => 'Not logged in']);
        }

        if (!$this->validateCsrfAjax()) {
            return $this->response->setStatusCode(403)->setJSON(['success' => false, 'message' => 'Invalid security token']);
        }

        $userId = session()->get('user_id');
        $rules = [
            'full_name' => 'required|string|min_length[2]|max_length[100]|regex_match[/^[a-zA-Z\s\-\'\.]+$/]',
            'email' => 'required|valid_email|max_length[255]|is_unique[users.email,id,' . $userId . ']',
            'job_title' => 'permit_empty|string|max_length[100]',
            'phone_number' => 'permit_empty|string|max_length[30]|regex_match[/^[\d\s\-\+\(\)]*$/]',
            'company' => 'permit_empty|string|max_length[255]',
            'optin' => 'permit_empty|in_list[0,1]',
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $this->validator->getErrors(),
                'csrf' => csrf_hash(),
            ]);
        }

        $data = [
            'name' => $this->request->getPost('full_name'),
            'email' => strtolower($this->request->getPost('email')),
            'job_title' => $this->request->getPost('job_title') ?: null,
            'phone_number' => $this->request->getPost('phone_number') ?: null,
            'company' => $this->request->getPost('company') ?: null,
            'optin' => (int) ($this->request->getPost('optin') ?: 0),
        ];

        if ($this->userModel->update($userId, $data)) {
            session()->set([
                'user_name' => $data['name'],
                'user_email' => $data['email'],
            ]);

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Profile updated successfully',
                'csrf' => csrf_hash(),
            ]);
        }

        return $this->response->setJSON([
            'success' => false,
            'message' => 'Update failed. Please try again.',
            'csrf' => csrf_hash(),
        ]);
    }

    public function changePassword()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(403)->setJSON(['success' => false]);
        }

        if (!session()->get('user_logged_in')) {
            return $this->response->setStatusCode(403)->setJSON(['success' => false, 'message' => 'Not logged in']);
        }

        if (!$this->validateCsrfAjax()) {
            return $this->response->setStatusCode(403)->setJSON(['success' => false, 'message' => 'Invalid security token']);
        }

        $rules = [
            'current_password' => 'required|string',
            'new_password' => 'required|min_length[8]|max_length[255]',
            'confirm_new_password' => 'required|matches[new_password]',
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $this->validator->getErrors(),
                'csrf' => csrf_hash(),
            ]);
        }

        $userId = session()->get('user_id');
        $user = $this->userModel->find($userId);

        if (!$user) {
            session()->destroy();
            return $this->response->setJSON(['success' => false, 'message' => 'User not found']);
        }

        $currentPassword = $this->request->getPost('current_password');
        if (!password_verify($currentPassword, $user['password'])) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Current password is incorrect',
                'csrf' => csrf_hash(),
            ]);
        }

        $newPassword = password_hash($this->request->getPost('new_password'), PASSWORD_BCRYPT);

        if ($this->userModel->update($userId, ['password' => $newPassword])) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Password changed successfully',
                'csrf' => csrf_hash(),
            ]);
        }

        return $this->response->setJSON([
            'success' => false,
            'message' => 'Password change failed. Please try again.',
            'csrf' => csrf_hash(),
        ]);
    }

    public function logout()
    {
        log_message('notice', '[User Logout] User ID: ' . session()->get('user_id') . ' (' . session()->get('user_email') . ') logged out | IP: ' . $this->request->getIPAddress());
        session()->destroy();
        return redirect()->to(base_url('/'))->with('message', 'Logged out successfully');
    }

    public function forgotPassword()
    {
        if (session()->get('user_logged_in')) {
            return redirect()->to(base_url('/'));
        }

        $data['recaptchaSiteKey'] = trim((string) env('recaptcha.siteKey', ''));
        $data['recaptchaEnabled'] = $this->recaptchaEnabled;

        return view('User/forgot-password', $data);
    }

    public function forgotPasswordSubmit()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(403)->setJSON(['success' => false]);
        }

        if (session()->get('user_logged_in')) {
            return $this->response->setJSON(['success' => false, 'message' => 'You are already logged in']);
        }

        if (!$this->validateCsrfAjax()) {
            return $this->response->setStatusCode(403)->setJSON(['success' => false, 'message' => 'Invalid security token']);
        }

        if (!$this->verifyCaptcha((string) $this->request->getPost('g-recaptcha-response'), 'forgot_password')) {
            return $this->response->setJSON(['success' => false, 'message' => 'Security verification failed', 'csrf' => csrf_hash()]);
        }

        $email = strtolower($this->request->getPost('email'));

        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Please enter a valid email address',
                'errors' => ['email' => 'Invalid email format'],
                'csrf' => csrf_hash(),
            ]);
        }

        // Check if user exists
        $user = $this->userModel->where('email', $email)->first();
        
        // For security, always return success message regardless of whether user exists
        $response = [
            'success' => true,
            'message' => 'If an account exists with this email, you will receive password reset instructions',
            'csrf' => csrf_hash(),
        ];

        if ($user) {
            // Generate reset token
            $token = $this->passwordResetModel->createResetToken($user['id']);
            
            // Send reset email
            if ($this->sendPasswordResetEmail($user, $token)) {
                return $this->response->setJSON($response);
            } else {
                // Email sending failed, but we still return success for security
                log_message('error', 'Failed to send password reset email to: ' . $email);
                return $this->response->setJSON($response);
            }
        }

        return $this->response->setJSON($response);
    }

    /**
     * Send password reset email to user
     */
    protected function sendPasswordResetEmail($user, $token)
    {
        $email = \Config\Services::email();
        
        $resetLink = base_url('reset-password?token=' . $token);
        
        $emailBody = view('User/Emails/password-reset', [
            'user' => $user,
            'resetLink' => $resetLink,
            'expiresIn' => '1 hour',
        ]);

        $email->setFrom(env('email.fromEmail'), env('email.fromName'));
        $email->setTo($user['email']);
        $email->setSubject('Reset Your TheITUpdates Password');
        $email->setMessage($emailBody);

        if ($email->send()) {
            return true;
        } else {
            log_message('error', 'Email service error: ' . $email->printDebugger());
            return false;
        }
    }

    public function resetPassword()
    {
        if (session()->get('user_logged_in')) {
            return redirect()->to(base_url('/'));
        }

        $token = $this->request->getGet('token');

        if (!$token) {
            return redirect()->to(base_url('forgot-password'))->with('error', 'Invalid password reset link');
        }

        // Validate token
        $resetRecord = $this->passwordResetModel->validateResetToken($token);

        if (!$resetRecord) {
            return redirect()->to(base_url('forgot-password'))->with('error', 'Password reset link has expired. Please try again.');
        }

        $data['token'] = $token;
        $data['user_id'] = $resetRecord['user_id'];

        return view('User/reset-password', $data);
    }

    public function resetPasswordSubmit()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(403)->setJSON(['success' => false]);
        }

        if (session()->get('user_logged_in')) {
            return $this->response->setJSON(['success' => false, 'message' => 'You are already logged in']);
        }

        $token = $this->request->getPost('token');
        $newPassword = $this->request->getPost('new_password');
        $confirmPassword = $this->request->getPost('confirm_password');

        // Validate token
        $resetRecord = $this->passwordResetModel->validateResetToken($token);

        if (!$resetRecord) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Password reset link has expired. Please request a new one.',
            ]);
        }

        // Validate passwords
        if (!$newPassword || !$confirmPassword) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'All fields are required',
                'errors' => [
                    'new_password' => 'Password is required',
                    'confirm_password' => 'Confirm password is required',
                ],
            ]);
        }

        if (strlen($newPassword) < 8) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Password must be at least 8 characters long',
                'errors' => ['new_password' => 'Password must be at least 8 characters long'],
            ]);
        }

        if ($newPassword !== $confirmPassword) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Passwords do not match',
                'errors' => ['confirm_password' => 'Passwords do not match'],
            ]);
        }

        // Update user password
        $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

        if ($this->userModel->update($resetRecord['user_id'], ['password' => $hashedPassword])) {
            // Delete the reset token
            $this->passwordResetModel->deleteResetToken($token);

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Password has been reset successfully. You can now log in with your new password.',
            ]);
        }

        return $this->response->setJSON([
            'success' => false,
            'message' => 'Password reset failed. Please try again.',
        ]);
    }

    protected function validateCsrfAjax(): bool
    {
        // Use CodeIgniter's CSRF service to validate the token
        // This properly handles the regenerate option and cookie/session storage
        $request = $this->request;
        $tokenName = csrf_token();
        $token = $request->getPost($tokenName);
        
        // For AJAX, we need to validate using the security service
        // CodeIgniter stores CSRF token in cookies when csrfProtection = 'cookie'
        // We need to check against the cookie value
        
        if (!$token) {
            return false;
        }
        
        // Get the CSRF from the request header as backup (X-CSRF-TOKEN)
        $headerToken = $request->getHeaderLine('X-CSRF-TOKEN');
        
        // Check if token was provided either as POST or header
        // The token will be validated by CodeIgniter's security service
        // which compares it against the stored hash
        
        // Get all the cookies from the request
        $cookies = $request->getCookie();
        
        // The CSRF hash should be in the csrf_cookie_name
        $cookieName = config('Security')->cookieName ?? 'csrf_cookie_name';
        $csrfFromCookie = $cookies[$cookieName] ?? '';
        
        if (!$csrfFromCookie) {
            // If not in cookies, it might be in a header
            if (!$headerToken) {
                return false;
            }
            $token = $headerToken;
        }
        
        // Now validate using hash_equals for timing-safe comparison
        if ($csrfFromCookie && $token) {
            return hash_equals($csrfFromCookie, $token);
        }
        
        return false;
    }

    protected function verifyCaptcha(string $token, string $expectedAction): bool
    {
        if (! $this->recaptchaEnabled) {
            return true;
        }

        if ($token === '') {
            $this->logCaptchaFailure('missing-token', $expectedAction);

            return false;
        }

        try {
            $response = Services::curlrequest()->post('https://www.google.com/recaptcha/api/siteverify', [
                'connect_timeout' => 3,
                'timeout'         => 7,
                'http_errors'     => false,
                'form_params'     => [
                    'secret'   => $this->recaptchaSecretKey,
                    'response' => $token,
                    'remoteip' => $this->request->getIPAddress(),
                ],
            ]);

            if ($response->getStatusCode() !== 200) {
                return $this->handleCaptchaServiceFailure(
                    'google-http-' . $response->getStatusCode(),
                    $expectedAction
                );
            }

            $data = json_decode($response->getBody(), true);
            if (! is_array($data)) {
                return $this->handleCaptchaServiceFailure('invalid-google-response', $expectedAction);
            }

            if (empty($data['success'])) {
                $errorCodes = isset($data['error-codes']) && is_array($data['error-codes'])
                    ? implode(',', $data['error-codes'])
                    : 'unknown';
                $this->logCaptchaFailure('google-rejected:' . $errorCodes, $expectedAction, $data);

                return false;
            }

            $version = strtolower(trim((string) env('recaptcha.version', 'v3')));
            if ($version !== 'v3') {
                return true;
            }

            $actualAction = (string) ($data['action'] ?? '');
            if (! hash_equals($expectedAction, $actualAction)) {
                $this->logCaptchaFailure('action-mismatch', $expectedAction, $data);

                return false;
            }

            $score     = (float) ($data['score'] ?? 0);
            $threshold = max(0.0, min(1.0, (float) env('recaptcha.v3Threshold', 0.3)));
            if ($score < $threshold) {
                $this->logCaptchaFailure('low-score', $expectedAction, $data);

                return false;
            }

            $allowedHostnames = array_values(array_filter(array_map(
                static fn (string $hostname): string => strtolower(trim($hostname)),
                explode(',', (string) env('recaptcha.allowedHostnames', ''))
            )));

            if ($allowedHostnames !== []) {
                $actualHostname = strtolower((string) ($data['hostname'] ?? ''));
                if (! in_array($actualHostname, $allowedHostnames, true)) {
                    $this->logCaptchaFailure('hostname-mismatch', $expectedAction, $data);

                    return false;
                }
            }

            return true;
        } catch (\Throwable $exception) {
            log_message('error', 'reCAPTCHA service error for action "{action}": {message}', [
                'action'  => $expectedAction,
                'message' => $exception->getMessage(),
            ]);

            return $this->captchaFailOpen();
        }
    }

    private function handleCaptchaServiceFailure(string $reason, string $expectedAction): bool
    {
        $this->logCaptchaFailure($reason, $expectedAction);

        return $this->captchaFailOpen();
    }

    private function captchaFailOpen(): bool
    {
        return filter_var(env('recaptcha.failOpenOnServiceError', false), FILTER_VALIDATE_BOOL);
    }

    private function logCaptchaFailure(string $reason, string $expectedAction, array $data = []): void
    {
        log_message(
            'warning',
            'reCAPTCHA rejected request: reason={reason}, expectedAction={expectedAction}, actualAction={actualAction}, score={score}, hostname={hostname}, ip={ip}',
            [
                'reason'         => $reason,
                'expectedAction' => $expectedAction,
                'actualAction'   => (string) ($data['action'] ?? ''),
                'score'          => isset($data['score']) ? (string) $data['score'] : '',
                'hostname'       => (string) ($data['hostname'] ?? ''),
                'ip'             => $this->request->getIPAddress(),
            ]
        );
    }
}
