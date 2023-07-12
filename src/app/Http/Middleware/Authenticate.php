<?php declare(strict_types=1);

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): RedirectResponse
    {
        return $request->expectsJson() ? null : response()->redirectTo('login');
    }
}
