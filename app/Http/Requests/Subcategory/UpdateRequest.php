<?php

namespace App\Http\Requests\Subcategory;

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
            'status' => 'required|integer',
            'industry_id' => 'required|integer',
            'category_id' => 'required|integer',
            'name_en' => 'required|min:1|string',
            'name_ro' => 'required|min:1|string',
            'name_ru' => 'required|min:1|string',
            'description_en' => 'required|min:1|string',
            'description_ro' => 'required|min:1|string',
            'description_ru' => 'required|min:1|string',
            'image_preview' => 'nullable',
            'image_main' => 'nullable',
            'image_second' => 'nullable',
            'length' => 'nullable|string',
            'depth' => 'nullable|string',
            'height' => 'nullable|string',
            'material' => 'nullable|string',
            'sort_order' => 'required|integer',
            'code_1c' => 'nullable',
            'recommend' => 'nullable',
            'hurakan_category1' => 'nullable',
            'hurakan_category2' => 'nullable',
            'hurakan_category3' => 'nullable',
            'hurakan_category4' => 'nullable',
            'hurakan_category5' => 'nullable',
        ];
    }
}
