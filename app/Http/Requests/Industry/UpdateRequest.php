<?php

namespace App\Http\Requests\Industry;

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
            'name' => 'required|min:1|string',
            'color' => 'required|min:1|string',
            'image_preview' => 'nullable|mimes:jpg,png,webp,jpeg',
            'image_main' => 'nullable|mimes:jpg,png,webp,jpeg',
            'pdf' => 'nullable|mimes:pdf',
            'sort_order' => 'required|integer',
        ];
    }
}
