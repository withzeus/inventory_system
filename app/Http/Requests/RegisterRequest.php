<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:6', 'max:24'],
            'email' => ['required', 'unique:users,email'],
            'password' => ['required', 'confirmed', 'min:8', 'max:72'],
        ];
    }

    #[Override]
    public function messages()
    {
        return [
            'name.required' => 'USERNAME IS REQUIRED.',
            'name.min' => 'USERNAME CANNOT BE LESS THAN 6 CHARS.',
            'name.max' => 'USERNAME CANNOT EXCEED 24 CHARS.',
            'email.required' => 'EMAIL ADDRESS IS REQUIRED.',
            'email.unique' => 'THIS EMAIL IS ALREADY TAKEN.',
            'password.required' => 'PASSWORD IS REQUIRED.',
            'password.confirmed' => 'PASSWORD CONFIRMATION DOESN\'T MATCH.',
            'password.min' => 'PASSWORD CANNOT BE LESS THAN 8 CHARS.',
            'password.max' => 'PASSWORD CANNOT EXCEED 72 CHARS.',
        ];
    }
}
