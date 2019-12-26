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
            'number_of_beds' => 'sometimes|nullable|numeric',
            'number_of_parking_spaces' => 'sometimes|nullable|numeric',
            'number_of_tenants' => 'sometimes|nullable|numeric',
            'property_type' => 'required',
            'number_of_bedrooms' => 'required|numeric',
            'asking_price' => 'required|numeric',
            'published_on' => 'required',
            'delivery_date' => 'sometimes|nullable|date',
            'common_costs' => 'sometimes|nullable|numeric',
            'asset_value'  => 'sometimes|nullable|numeric',
          
        ];
    }
}
