<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function rules()
    {
        return [
            'username' => 'required',
            'phone' => 'required',
        ];
    }

    public function authorize()
    {
        return true;
    }
}
