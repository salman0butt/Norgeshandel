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

            'gross_area_from' => 'required',
            'gross_area_to' => 'required',
           
         
            'floors' => 'required',
            'year_of_construction-on' => 'required',

           
            'headline' => 'required',
         
            'published-on' => 'required',




    ];
    }
}
