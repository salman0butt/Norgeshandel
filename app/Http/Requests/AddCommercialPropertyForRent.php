<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddCommercialPropertyForRent extends FormRequest
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
            //
            'property_type' => 'required',
            'countrty' => 'required',
            'zip_code' => 'required',
            'municipal_number' => 'sometimes|nullable|numeric',
            'usage_number' => 'sometimes|nullable|numeric',
            'farm_number' => 'sometimes|nullable|numeric',
            'gross_area_from' => 'required',
            'gross_area_to' => 'required',
            'use_area' => 'sometimes|nullable|numeric',
            'land' => 'sometimes|nullable|numeric',
            'number_of_office_space' => 'sometimes|nullable|numeric',
            'number_of_parking_space' => 'sometimes|nullable|numeric',
            'floors' => 'sometimes|nullable|numeric',
            'year_of_construction' => 'sometimes|nullable|numeric',
            'rennovated_year' => 'sometimes|nullable|numeric',
            'rent_per_meter_per_year' => 'sometimes|nullable|numeric',
            'heading' => 'required',

        ];
    }
}
