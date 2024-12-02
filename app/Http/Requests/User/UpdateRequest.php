<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:2|string',
            'status' => 'nullable|integer',
            'login' => 'required|min:3|string',
            'email' => 'required|email|string',
            'password' => 'nullable|min:5|string',
            'role_id' => 'nullable|integer',

        ];
    }
}
