<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'email'         => 'required|string|email|unique:users,email',
            'password'      => 'required|string|min:4|max:255',
            'username'      => 'required|string|max:255|unique:users,username',
            'name'          => 'required|string|max:255',
            'avatar'        => 'nullable|string|max:255',
        ];
    }
}
