<?php

namespace App\Http\Requests\Order;

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
            'name'=>'required|string',
            'surname'=>'required|string',
            'phone'=>'required|string',
            'email'=>'required|string|email',
            'address'=>'nullable|string',
            'comment'=>'nullable|string',
            'paymentType'=>'required|integer',
            'deliveryType'=>'required|integer',
            'products'=>'required|string',
            'location'=>'required|string',
            'priceProducts'=>'required|integer',
            'priceDelivery'=>'required|integer',
            'priceTotal'=>'required|integer',

            'juridic_type'=>'nullable|string',
            'company_name'=>'nullable|string',
            'tva'=>'nullable|string',
            'juridic_address'=>'nullable|string',
            'fiscal_code'=>'nullable|string',
            'physical_address'=>'nullable|string',
            'bank_name'=>'nullable|string',
            'bank_code'=>'nullable|string',
            'iban'=>'nullable|string',


        ];
    }
}
