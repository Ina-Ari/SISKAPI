<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'email' => ['required', 'email'],
            'type' => ['required', 'string', 'in:student,employee'],
        ];

        $additionalRules = $this->has('nim')
            ? ['nim' => ['required', 'numeric', 'digits:10']]
            : ['token' => ['required', 'string', 'size:' . config('auth.registration_token.length')]];

        return array_merge($rules, $additionalRules);
    }
}
