<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthUserLinkRequest;
use App\Http\Requests\GenerateUserLinkRequest;
use App\Services\UsersService;

class UsersController extends Controller
{
    public function generateLink(AuthUserLinkRequest $request, UsersService $service)
    {
        $validated = $request->validated();

        $user = $service->getByAuthLink($validated['auth_link']);

        if ($user == null) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->generateLink()->save();

        return response()->json(['auth_link' => $user->auth_link]);
    }

    public function destroyLink(AuthUserLinkRequest $request, UsersService $service)
    {
        $validated = $request->validated();

        $user = $service->getByAuthLink($validated['auth_link']);

        $user->auth_link = '';
        $user->save();

        return response()->json(['message' => 'Link destroyed']);
    }
}
