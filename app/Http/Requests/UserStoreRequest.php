<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'     => ['required', 'string'],
            'email'    => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:6'],
            'gender' => ['required', 'in:male,female'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'     => 'Имя обязательно.',
            'email.required'    => 'Email обязателен.',
            'email.email'       => 'Email должен быть валидным.',
            'email.unique'      => 'Такой email уже зарегистрирован.',
            'gender.required'   => 'Пол обязателен.',
        ];
    }
}
