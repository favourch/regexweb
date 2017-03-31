<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'student-login',
	    'student-transcript',
	    'course-details',
	    'student-change-password',
	    'lecturer-get-comments',
	    'student-get-comments',
	    'post-comment',
	    'get-staff-comment-users'
    ];
}
