<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddFlatWishesRented extends FormRequest
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
        return [
            'number_of_tenants' => 'sometimes|nullable|numeric',
            'wanted_from' => 'sometimes|nullable|date',
            'max_rent_per_month' => 'sometimes|nullable|numeric',
            'region' => 'required',
            'property_type' => 'required',   
            'headline' => 'required',
        ];
    }
}
