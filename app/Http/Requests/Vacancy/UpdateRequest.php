<?php

namespace App\Http\Requests\Vacancy;

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
            'name_en' => 'required|min:1|string',
            'name_ro' => 'required|min:1|string',
            'name_ru' => 'required|min:1|string',
            'location_en' => 'required|min:1|string',
            'location_ro' => 'required|min:1|string',
            'location_ru' => 'required|min:1|string',
            'department_en' => 'required|min:1|string',
            'department_ro' => 'required|min:1|string',
            'department_ru' => 'required|min:1|string',
            'description_en' => 'required|min:1|string',
            'description_ro' => 'required|min:1|string',
            'description_ru' => 'required|min:1|string',
//            'image' => 'nullable',
            'sort_order' => 'required|integer',
        ];
    }
}
