<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'UsernameInput' => 'required',
            'emailInput' => 'required|email',
            'passwordInput' => 'required|min:8|confirmed',
        ];
    }
}
