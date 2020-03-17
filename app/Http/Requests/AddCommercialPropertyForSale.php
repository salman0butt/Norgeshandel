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
    
     public function messages()
    {
        return [
            'headline.required' => 'overskriftsfeltet er påkrevd.',
            'property_type.required' => 'feltet for eiendomstype er påkrevd.',
            'location.required' => 'plasseringsfeltet er påkrevd.',
            'zip_code.required' => 'postnummerfeltet er påkrevd.',
            'gross_area_from.required' => 'bruttoareal fra felt er påkrevd.',
            'gross_area_to.required' => 'feltet gross_area_to er påkrevd.',
            'municipal_number.numeric' => 'kommunens nummer må være numerisk.', 
            'usage_number.numeric' => 'bruksnummeret må være numerisk.', 
            'farm_number.numeric' => 'gårdsnummeret må være numerisk.', 
            'use_area.numeric' => 'Bruksområdefeltet må være numerisk.', 
            'land.numeric' => 'landfeltet må være numerisk.', 
            'number_of_office_space.numeric' => 'antall kontorplasser må være numeriske.', 
            'number_of_parking_space.numeric' => 'antall parkeringsplasser må være numeriske.', 
            'floors.numeric' => 'gulvfeltet må være numerisk.', 
            'year_of_construction.numeric' => 'byggeårets felt må være numerisk.', 
            'rennovated_year.numeric' => 'det gjeninnførte årsfeltet må være numerisk.', 
            'rental_income.numeric' => 'leieinntektsfeltet må være numerisk.', 
            'value_rate.numeric' => 'målsettingsfeltet må være numerisk.', 
            'loan_rate.numeric' => 'lånet skal være numerisk.', 
            'rent_per_meter_per_year.numeric' => 'må leien per meter per år være numerisk.', 
        ];
    }

}
