<?php

namespace App\Http\Requests;

use App\Services\UsersService;
use Illuminate\Foundation\Http\FormRequest;

class HomeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'auth_link' => 'required|string'
        ];
    }

    public function authorize(): bool
    {
//        $user = UsersService::getByAuthLink($this->get('auth_link'));
//
//        if ($user == null) {
//            return false;
//        }

        return true;
    }
}
