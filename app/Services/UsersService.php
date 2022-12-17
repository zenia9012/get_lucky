<?php

namespace App\Services;

use App\Models\User;

class UsersService
{
    public function get(string $username, string $phone)
    {
        $user = User::where('username', $username)
            ->where('phone', $phone)
            ->first();

        if ($user == null) {
            $user = new User();
            $user->username = $username;
            $user->phone = $phone;
        }

        return $user;
    }

    public static function getByAuthLink(string $authLink)
    {
        return User::where('auth_link', $authLink)->first();
    }

    public function store(string $username, string $phone, bool $isAdmin = false)
    {
        $user = new User();
        $user->username = $username;
        $user->phone = $phone;
        $user->is_admin = $isAdmin;
        $user->generateLink()->save();
    }

}
