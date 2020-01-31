<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddPropertyHolidayHomeForSale extends FormRequest
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
           
            'ad_headline' => 'required',
            'zip_code' => 'required|numeric',
            'location' => 'required',
            'property_type' => 'required',
            'muncipal_number' => 'sometimes|nullable|numeric',
            'farm_number'   => 'sometimes|nullable|numeric',
            'usage_number'  => 'sometimes|nullable|numeric',
            'section_number'  => 'sometimes|nullable|numeric',
            'party_number'  => 'sometimes|nullable|numeric',
            'use_area'  => 'sometimes|nullable|numeric',
            'primary_room'  => 'required|numeric',
            'gross_area'  => 'sometimes|nullable|numeric',
            'base'  => 'sometimes|nullable|numeric',
            'housing_area'  => 'sometimes|nullable|numeric',
            'year_of_construction'  => 'sometimes|nullable|numeric',
            'renovated_year'  => 'sometimes|nullable|numeric',
            'number_of_bedrooms' => 'required|numeric',
            'number_of_beds' => 'sometimes|nullable|numeric',
            'number_of_parking_spaces' => 'sometimes|nullable|numeric',
            'meter_above_sea_level' => 'sometimes|nullable|numeric',
            'land' => 'sometimes|nullable|numeric',
            'party_fee' => 'sometimes|nullable|numeric',
            'number_of_tenants' => 'sometimes|nullable|numeric',
            'common_costs' =>'sometimes|nullable|numeric',
            'joint_board_after_interest_fee_period' =>'sometimes|nullable|numeric',
            'shared_costs_include' =>'sometimes|nullable',
            'asset_value' =>'sometimes|nullable|numeric',
            'asking_price' => 'required|numeric',
            'cost' =>'sometimes|nullable|numeric',
            'cost_includes' =>'sometimes|nullable',
            'prcentage_of_joint_debt' =>'sometimes|nullable|numeric',
            'total_price' =>'sometimes|nullable|numeric',
            'value_rate' =>'sometimes|nullable|numeric',
            'loan_rate' =>'sometimes|nullable|numeric',
            'percentage_of_common_health' =>'sometimes|nullable|numeric',
            'common_costs' => 'sometimes|nullable|numeric',
            'asset_value'  => 'sometimes|nullable|numeric',
          
        ];
    }
}
