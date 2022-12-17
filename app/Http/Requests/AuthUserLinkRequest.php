<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthUserLinkRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'auth_link' => 'required|string',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
