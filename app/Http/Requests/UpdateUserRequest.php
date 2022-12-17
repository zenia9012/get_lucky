<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'username' => 'required|string|max:191',
            'phone' => 'required|string|max:20',
            'is_admin' => 'required|integer',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
