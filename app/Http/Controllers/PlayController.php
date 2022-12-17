<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthUserLinkRequest;
use App\Services\PlaysService;
use App\Services\UsersService;

class PlayController extends Controller
{
    public function getLucky(AuthUserLinkRequest $request, PlaysService $service)
    {
        $validated = $request->validated();

        $user = UsersService::getByAuthLink($validated['auth_link']);

        if ($user == null) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $play = $service->store($user->id);

        return response()->json($play);
    }

    public function index(AuthUserLinkRequest $request, PlaysService $service)
    {
        $validated = $request->validated();

        $user = UsersService::getByAuthLink($validated['auth_link']);

        if ($user == null) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $plays = $service->getHistory($user->id);

        return response()->json($plays);
    }
}
