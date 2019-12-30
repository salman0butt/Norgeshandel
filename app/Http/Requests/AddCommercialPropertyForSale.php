<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddCommercialPropertyForSale extends FormRequest
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
            'location' => 'required',
            'zip_code' => 'required',

            'municipal_number' => 'sometimes|nullable|numeric',
            'usage_number' => 'sometimes|nullable|numeric',
            'farm_number' => 'sometimes|nullable|numeric',

            'gross_area_from' => 'required',
            'gross_area_to' => 'required',
            
            'primary_room' => 'sometimes|nullable|numeric',
            'use_area' => 'sometimes|nullable|numeric',
            'land' => 'sometimes|nullable|numeric',
            'number_of_office_space' => 'sometimes|nullable|numeric',
            'number_of_parking_space' => 'sometimes|nullable|numeric',
            'floors' => 'sometimes|nullable|numeric',
            'year_of_construction' => 'sometimes|nullable|numeric',
            'rennovated_year' => 'sometimes|nullable|numeric',

            'rental_income' => 'sometimes|nullable|numeric',
            'value_rate' => 'sometimes|nullable|numeric',
            'loan_rate' => 'sometimes|nullable|numeric',
           
            'headline' => 'required',
        

        ];
    }
}
