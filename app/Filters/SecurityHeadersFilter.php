<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * SecurityHeadersFilter
 *
 * Adds browser-level security headers to every response:
 *  - X-Frame-Options        : Prevents clickjacking
 *  - X-Content-Type-Options : Prevents MIME-type sniffing
 *  - X-XSS-Protection       : Legacy XSS filter hint for older browsers
 *  - Referrer-Policy        : Controls referrer information
 *  - Permissions-Policy     : Restricts browser feature access
 *  - Strict-Transport-Security (HSTS): Enforced only over HTTPS
 *  - X-Permitted-Cross-Domain-Policies: Blocks Flash/Acrobat cross-domain reads
 */
class SecurityHeadersFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // No action needed before the response
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        $response->setHeader('X-Frame-Options', 'SAMEORIGIN');
        $response->setHeader('X-Content-Type-Options', 'nosniff');
        $response->setHeader('X-XSS-Protection', '1; mode=block');
        $response->setHeader('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->setHeader('Permissions-Policy', 'camera=(), microphone=(), geolocation=(), payment=()');
        $response->setHeader('X-Permitted-Cross-Domain-Policies', 'none');

        // HSTS: only send when the connection is actually HTTPS
        if ($request->isSecure()) {
            $response->setHeader('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');
        }

        return $response;
    }
}
