<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddPropertyForRent extends FormRequest
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
            'heading' => 'required',
            'zip_code' => 'required|numeric',
            'street_address' => 'required',
            'property_type' => 'required',
            'primary_rom' => 'required|numeric',
            'gross_area' => 'sometimes|nullable|numeric',
            'area_of_use' => 'sometimes|nullable|numeric',
            'number_of_bedrooms' => 'required|numeric',
            'floor' => 'sometimes|nullable|numeric',
            'furnishing' => 'required',
            'monthly_rent' => 'required|numeric',
            'deposit' => 'sometimes|nullable|numeric',
            'rented_from' => 'required|date',
            'rented_to' => 'sometimes|date',
            'published_on' => 'required',  
            
        ];
    }
}
