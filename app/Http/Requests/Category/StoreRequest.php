<?php

namespace App\Http\Requests\Category;

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
            'name_en' => 'required|min:1|string',
            'name_ro' => 'required|min:1|string',
            'name_ru' => 'required|min:1|string',
            'description_en' => 'required|min:1|string',
            'description_ro' => 'required|min:1|string',
            'description_ru' => 'required|min:1|string',
            'image_preview' => 'nullable',
            'image_main' => 'nullable',
            'tags_ro' => 'nullable',
            'tags_ru' => 'nullable',
            'tags_en' => 'nullable',
            'sort_order' => 'required|integer',
            'created_by' => 'required|integer',


        ];
    }
}