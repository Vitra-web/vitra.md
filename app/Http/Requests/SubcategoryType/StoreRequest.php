<?php

namespace App\Http\Requests\SubcategoryType;

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
            'subcategory_id' => 'required|integer',
            'title_en' => 'required|min:1|string',
            'title_ro' => 'required|min:1|string',
            'title_ru' => 'required|min:1|string',
            'description_en' => 'required|min:1|string',
            'description_ro' => 'required|min:1|string',
            'description_ru' => 'required|min:1|string',
            'image_preview' => 'nullable',
            'length' => 'nullable|string',
            'depth' => 'nullable|string',
            'height' => 'nullable|string',
            'perforation_pitch' => 'nullable|string',
            'inclination_angle' => 'nullable|string',
            'shelf_height' => 'nullable|string',
            'sort_order' => 'nullable|integer',

            'available_basins' => 'nullable|string',
            'electrical_parameters' => 'nullable|string',
            'available_conveyors' => 'nullable|string',
            'protection_class' => 'nullable|string',
            'certificates' => 'nullable|string',
            'processor' => 'nullable|string',
            'operating_system' => 'nullable|string',
            'software' => 'nullable|string',
            'shelves_depth' => 'nullable|string',
            'temperature_class' => 'nullable|string',
            'cooling_system' => 'nullable|string',
            'refrigerant' => 'nullable|string',

            'maximum_lifting_height' => 'nullable|string',
            'battery_type' => 'nullable|string',
            'platform_area' => 'nullable|string',
            'maximum_load' => 'nullable|string',
            'fork_width' => 'nullable|string',
            'fork_length' => 'nullable|string',
            'battery_capacity' => 'nullable|string',
            'weight' => 'nullable|string',
            'volume' => 'nullable|string',
            'maximum_height' => 'nullable|string',
            'minimum_height' => 'nullable|string',


            'construction_principle_ro' => 'nullable|string',
            'construction_principle_ru' => 'nullable|string',
            'construction_principle_en' => 'nullable|string',
            'electricity_connection_ro' => 'nullable|string',
            'electricity_connection_ru' => 'nullable|string',
            'electricity_connection_en' => 'nullable|string',
            'working_places_ro' => 'nullable|string',
            'working_places_ru' => 'nullable|string',
            'working_places_en' => 'nullable|string',
            'warranty_ro' => 'nullable|string',
            'warranty_ru' => 'nullable|string',
            'warranty_en' => 'nullable|string',
            'touch_screen_ro' => 'nullable|string',
            'touch_screen_ru' => 'nullable|string',
            'touch_screen_en' => 'nullable|string',
            'interactive_support_ro' => 'nullable|string',
            'interactive_support_ru' => 'nullable|string',
            'interactive_support_en' => 'nullable|string',
            'integration_options_ro' => 'nullable|string',
            'integration_options_ru' => 'nullable|string',
            'integration_options_en' => 'nullable|string',
            'barcode_scanner_ro' => 'nullable|string',
            'barcode_scanner_ru' => 'nullable|string',
            'barcode_scanner_en' => 'nullable|string',
            'integrated_accessories_ro' => 'nullable|string',
            'integrated_accessories_ru' => 'nullable|string',
            'integrated_accessories_en' => 'nullable|string',


            'material_ro' => 'nullable|string',
            'material_ru' => 'nullable|string',
            'material_en' => 'nullable|string',
            'advantages_ro' => 'nullable|string',
            'advantages_ru' => 'nullable|string',
            'advantages_en' => 'nullable|string',
            'coating_ro' => 'nullable|string',
            'coating_en' => 'nullable|string',
            'coating_ru' => 'nullable|string',
            'type_ro' => 'nullable|string',
            'type_en' => 'nullable|string',
            'type_ru' => 'nullable|string',
            'components_ro' => 'nullable|string',
            'components_en' => 'nullable|string',
            'components_ru' => 'nullable|string',
            'install_ro' => 'nullable|string',
            'install_en' => 'nullable|string',
            'install_ru' => 'nullable|string',
            'panel_type_ro' => 'nullable|string',
            'panel_type_en' => 'nullable|string',
            'panel_type_ru' => 'nullable|string',

            'front_type_ro' => 'nullable|string',
            'front_type_en' => 'nullable|string',
            'front_type_ru' => 'nullable|string',
            'energy_efficiency_class_ro' => 'nullable|string',
            'energy_efficiency_class_en' => 'nullable|string',
            'energy_efficiency_class_ru' => 'nullable|string',
            'energy_efficient_features_ro' => 'nullable|string',
            'energy_efficient_features_en' => 'nullable|string',
            'energy_efficient_features_ru' => 'nullable|string',

            'wheel_ro' => 'nullable|string',
            'wheel_en' => 'nullable|string',
            'wheel_ru' => 'nullable|string',

            'created_by' => 'required|integer',


        ];
    }
}
