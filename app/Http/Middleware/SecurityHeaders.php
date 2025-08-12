<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SecurityHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Content Security Policy (CSP) yang sangat ketat, bisa sesuaikan
        $csp = "default-src 'self'; ".
               "script-src 'self' 'unsafe-inline' https://trusted.cdn.com; ".
               "style-src 'self' 'unsafe-inline' https://trusted.cdn.com; ".
               "img-src 'self' data: https://trusted.cdn.com; ".
               "font-src 'self' https://fonts.gstatic.com; ".
               "connect-src 'self' https://api.example.com; ".
               "frame-ancestors 'none'; ".
               "base-uri 'self'; ".
               "form-action 'self';";

        $response->headers->set('Content-Security-Policy', $csp);

        // Strict-Transport-Security (HSTS) untuk HTTPS only, maksimal 2 tahun (63072000 detik), includeSubDomains & preload
        $response->headers->set('Strict-Transport-Security', 'max-age=63072000; includeSubDomains; preload');

        // Mencegah MIME sniffing
        $response->headers->set('X-Content-Type-Options', 'nosniff');

        // Mencegah clickjacking
        $response->headers->set('X-Frame-Options', 'DENY');

        // Mengontrol referrer info yang dikirim
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');

        // Permissions policy (mengganti feature-policy) — atur fitur apa saja yang boleh digunakan browser
        $response->headers->set('Permissions-Policy', 'geolocation=(), microphone=(), camera=()');

        // Expect Certificate Transparency
        $response->headers->set('Expect-CT', 'max-age=86400, enforce');

        // Cross-Origin Opener Policy
        $response->headers->set('Cross-Origin-Opener-Policy', 'same-origin');

        // Cross-Origin Embedder Policy
        $response->headers->set('Cross-Origin-Embedder-Policy', 'require-corp');

        // Cross-Origin Resource Policy
        $response->headers->set('Cross-Origin-Resource-Policy', 'same-origin');

        return $response;
    }
}
