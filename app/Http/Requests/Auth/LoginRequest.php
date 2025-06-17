<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class LoginRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username' => ['required', function(string $attribute, string $value, \Closure $fail) {
                $isEmail = filter_var($value, FILTER_VALIDATE_EMAIL);
                $isNIP = preg_match('/^\d{18}$/', $value);
                $isNIM = preg_match('/^\d{10}$/', $value);

                if (!$isEmail && !$isNIP && !$isNIM) {
                    $fail(__('validation.custom.username.username'));
                }
            }],
            'password' => ['required', Password::min(8)->letters()->numbers()],
            'remember' => ['boolean']
        ];
    }
}
