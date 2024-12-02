<?php

namespace App\Http\Requests\Product;

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
            'category_id' => 'nullable|array',
            'subcategory_id' => 'nullable|array',
            'name_en' => 'required|min:1|string',
            'name_ro' => 'required|min:1|string',
            'name_ru' => 'required|min:1|string',
            'description_en' => 'required|min:1|string',
            'description_ro' => 'required|min:1|string',
            'description_ru' => 'required|min:1|string',
            'image_preview' => 'nullable',
            'images' => 'nullable',
            'price' => 'nullable|integer',
            'stock' => 'required|integer',
//            'sort_order' => 'required|integer',
            'created_by' => 'required|integer',
            'code_1c' => 'nullable|string',
            'material' => 'nullable|string',
            'weight' => 'nullable|string',
            'dimension' => 'nullable|string',
            'pdf' => 'nullable|mimes:pdf',
            'video' => 'nullable|mimes:mp4,mov,wmv,webm',
            'variantItems' => 'nullable',
            'specificationItems' => 'nullable',
            'featuresItems' => 'nullable',
            'badge_top' => 'nullable|integer',
            'badge_new' => 'nullable|integer',
            'badge_moldova' => 'nullable|integer',
            'recommend' => 'nullable|integer',
            'brand' => 'nullable|string',
            'power' => 'nullable|string',
            'color' => 'nullable|string',
            'color_name_ro' => 'nullable|string',
            'color_name_ru' => 'nullable|string',
            'color_name_en' => 'nullable|string',
            'volume' => 'nullable|string',
            'capacity' => 'nullable|string',
            'voltage' => 'nullable|string',
            'rotation_speed' => 'nullable|string',
            'water_consumption' => 'nullable|string',
            'cycle_duration' => 'nullable|string',
            'maximum_temperature' => 'nullable|string',
            'frequency' => 'nullable|string',
            'shelf_number' => 'nullable|integer',
            'constructor_id' => 'nullable|integer',
        ];
    }
}
