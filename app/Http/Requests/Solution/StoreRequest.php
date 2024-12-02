<?php

namespace App\Http\Requests\Solution;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'status' => 'required|integer',
            'industry_id' => 'required|integer',
            'category_id' => 'required|integer',
            'image' => 'nullable',
            'items' => 'nullable',
            'main_page' => 'nullable',
            'ratio_id' => 'nullable|integer',
            'created_by' => 'required|integer',


        ];
    }
}