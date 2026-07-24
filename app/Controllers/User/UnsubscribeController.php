<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\UnsubscribeModel;

class UnsubscribeController extends BaseController
{
    public function index()
    {
        $source = (string) ($this->request->getGet('source')
            ?: $this->request->getServer('HTTP_REFERER')
            ?: '');

        return view('User/unsubscribe', [
            'landingPage' => $this->safeLandingPage($source),
        ]);
    }

    public function store()
    {
        $rules = [
            'email_address' => 'required|valid_email|max_length[190]',
            'landing_page'  => 'permit_empty|max_length[2048]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $model = new UnsubscribeModel();
        $saved = $model->insert([
            'email_address' => strtolower(trim((string) $this->request->getPost('email_address'))),
            'landing_page'  => $this->safeLandingPage((string) $this->request->getPost('landing_page')),
            'ip_address'    => $this->request->getIPAddress(),
            'user_agent'    => mb_substr((string) $this->request->getUserAgent(), 0, 500),
        ]);

        if ($saved === false) {
            log_message('error', 'Unable to save unsubscribe request: {errors}', [
                'errors' => json_encode($model->errors()),
            ]);

            return redirect()->back()
                ->withInput()
                ->with('error', 'We could not process your request. Please try again.');
        }

        return redirect()->to(base_url('unsubscribe'))->with(
            'success',
            'Thank you for being with us.'
        );
    }

    private function safeLandingPage(string $value): string
    {
        $value = trim($value);
        if ($value === '') {
            return '';
        }

        $url = filter_var($value, FILTER_VALIDATE_URL);
        if ($url === false || ! in_array(strtolower((string) parse_url($url, PHP_URL_SCHEME)), ['http', 'https'], true)) {
            return '';
        }

        return mb_substr($url, 0, 2048);
    }
}
