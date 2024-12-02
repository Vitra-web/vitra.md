<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
      '/search-more',
      '/consultation',
      '/main-page-consultation',
      '/contact-mail',
      '/vacancy-mail',
      '/feedback-mail',
      '/send-message',
      '/webhook-our-chat',
      '/vacancy-mail-full',
      '/vacancy-special',
      '/maib-callback',

    ];
}
