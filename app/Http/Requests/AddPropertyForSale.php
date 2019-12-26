<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddPropertyForSale extends FormRequest
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
          
            'headline' => 'required',
            'zip_code' => 'required|numeric',
            'street_address' => 'required',
            'property_type' => 'required',
            'tenure' => 'required',
            'municipality_number' => 'required|numeric',
            'farm_number'   => 'required|numeric',
            'usage_number'   => 'required|numeric',
            'party_number'   => 'sometimes|nullable|numeric',
            'section_number'   => 'sometimes|nullable|numeric',
            'apartment_number'   => 'sometimes|nullable|numeric',
            'use_area'   => 'required|numeric',
            'primary_room'   => 'required|numeric',
            'Base'   => 'sometimes|nullable|numeric',
            'year'   => 'required|numeric',
            'renovated_year' => 'sometimes|nullable|numeric',
            'number_of_bedrooms' => 'required|numeric',
            'number_of_rooms' => 'sometimes|nullable|numeric',
            'floor' => 'sometimes|nullable|numeric',
            'land'  => 'sometimes|nullable|numeric',
            'holiday_year'  => 'sometimes|nullable|numeric',
            'party_fee'  => 'sometimes|nullable|numeric',
            'rent_shared_cost' => 'required|numeric',
            'shared_costs_include' => 'required',
            'common_costs_after_interest_free_period'  => 'sometimes|nullable|numeric',
            'asset_value' => 'required|numeric',
            'asking_price' => 'required|numeric',
            'expenses' => 'required|numeric',
            'costs_include' => 'required|numeric',
            'percentage_of_public_debt' => 'required|numeric',
            'value_rate' => 'sometimes|nullable|numeric',
            'loan_rate' => 'sometimes|nullable|numeric',
            'percentage_of_common_wealth' => 'sometimes|nullable|numeric',
            'muncipal_fees_per_year' => 'sometimes|nullable|numeric',
          

        ];
    }
}
