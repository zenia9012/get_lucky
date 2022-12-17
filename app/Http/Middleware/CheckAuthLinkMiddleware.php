<?php

namespace App\Http\Middleware;

use App\Services\UsersService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAuthLinkMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $authLink = $request->get('auth_link');

        // if authLink is not set, redirect to login page
        if ($authLink == null) {
            Auth::logout();
            return redirect()->route('login');
        }


        $user = UsersService::getByAuthLink($authLink);
        if ($user == null) {
            Auth::logout();
            return redirect()->route('login');
        }

        if ($user->isLinkExpired()) {
            Auth::logout();
            return redirect()->route('login');
        }

        return $next($request);
    }
}
