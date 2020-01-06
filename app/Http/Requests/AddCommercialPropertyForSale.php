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
            'year_of_construction' => 'required',
            'headline' => 'required',
            'published-on' => 'required',

        ];
    }
    public function messages()
    {
        return [
            'headline.required' => 'Feltet overskrift er påkrevd.',
            'zip_code.required'  => 'Feltet post kode er påkrevd.',
            'zip_code.numeric'  => 'Feltet post kode må være numerisk.',
            'location.required'  => 'Feltet gateadresse er påkrevd.',
            'property_type.required'  => 'Feltet Eiendomstype er påkrevd.',
            'gross_area.required'  => 'Feltet brutto areal er påkrevd.',
            'gross_area.numeric'  => 'Feltet brutto areal må være numerisk.',
            'floor.required'  => 'Feltet gulv er påkrevd.',
            'year_of_construction.required'  => 'byggeår er påkrevd.',
            'floor.numeric'  => 'Feltet gulv må være numerisk.',
            'published-on.required'  => 'Feltet publisert den er påkrevd.',
        ];
    }
}
