<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $this->isMethod('GET') ? [] : [
            'logo' => 'sometimes|array',
            'logo.*' => 'nullable|image',

            'company' => 'required|array',
            'company.name' => 'required',
            'company.email' => 'required',
            'company.phone' => 'required',
            'company.tagline' => 'required',
            'company.address' => 'required',

            'social' => 'required|array',

            'products_page.rows' => 'required|integer',
            'products_page.cols' => 'required|integer',
            'related_products.rows' => 'required|integer',
            'related_products.cols' => 'required|integer',

            'call_for_order' => 'sometimes',
            'scroll_text' => 'sometimes',
            'pixel_ids' => 'sometimes',

            'delivery_charge.inside_dhaka' => 'sometimes|integer',
            'delivery_charge.outside_dhaka' => 'sometimes|integer',
            'delivery_text' => 'sometimes',

            'services' => 'sometimes|nullable|array',
            'services.*' => 'sometimes|nullable|array',
            'services.*.*' => 'sometimes|nullable|string|max:255',
        ];
    }
}
