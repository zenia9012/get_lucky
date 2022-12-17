<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Services\UsersService;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.users.index', [
            'users' => User::all(),
        ]);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', [
            'user' => $user,
        ]);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->validated());

        return redirect()->route('admin.users.index');
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(UpdateUserRequest $request, UsersService $usersService)
    {
        $validated = $request->validated();

        $usersService->store($validated['username'], $validated['phone'], $validated['is_admin'] ?? false);

        return redirect()->route('admin.users.index');
    }

}
