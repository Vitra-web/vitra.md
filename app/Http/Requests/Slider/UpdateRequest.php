<?php

namespace App\Http\Requests\Slider;

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
            'slider_category_id' => 'required|integer',
            'name_en' => 'required|min:1|string',
            'name_ro' => 'required|min:1|string',
            'name_ru' => 'required|min:1|string',
            'description_en' => 'nullable|string',
            'description_ro' => 'nullable|string',
            'description_ru' => 'nullable|string',
            'image' => 'nullable',
            'image_mobile' => 'nullable',
            'video' => 'nullable',
            'link' => 'nullable|string',
            'sort_order' => 'required|integer',
        ];
    }
}
