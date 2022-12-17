<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Services\UsersService;
use Auth;

class LoginController extends Controller
{
    private UsersService $userService;

    public function __construct()
    {
        $this->userService = new UsersService();
        $this->middleware('guest');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $validated = $request->validated();

        $user = $this->userService->get($validated['username'], $validated['phone']);

        $user->generateLink()->save();

        Auth::login($user);

        return redirect()->route('home', ['auth_link' => $user->auth_link]);
    }
}
