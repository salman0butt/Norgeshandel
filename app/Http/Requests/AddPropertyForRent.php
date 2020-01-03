<?php

namespace App\Http\Requests;

use http\Env\Request;
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
    public function messages()
    {
        return [
            'heading.required' => 'Feltet overskrift er påkrevd.',
            'zip_code.required'  => 'Feltet post kode er påkrevd.',
            'zip_code.numeric'  => 'Feltet post kode må være numerisk.',
            'street_address.required'  => 'Feltet gateadresse er påkrevd.',
            'property_type.required'  => 'Feltet Eiendomstype er påkrevd.',
            'primary_rom.required'  => 'Feltet primærrom er påkrevd.',
            'primary_rom.numeric'  => 'Feltet primærrom må være numerisk.',
            'gross_area.required'  => 'Feltet brutto areal er påkrevd.',
            'gross_area.numeric'  => 'Feltet brutto areal må være numerisk.',
            'area_of_use.required'  => 'Feltet bruksområde er påkrevd.',
            'area_of_use.numeric'  => 'Feltet bruksområde må være numerisk.',
            'number_of_bedrooms.required'  => 'Feltet antall soverom er påkrevd.',
            'number_of_bedrooms.numeric'  => 'Feltet antall soverom må være numerisk.',
            'floor.required'  => 'Feltet gulv er påkrevd.',
            'floor.numeric'  => 'Feltet gulv må være numerisk.',
            'furnishing.required'  => 'Feltet møblering er påkrevd.',
            'monthly_rent.required'  => 'Feltet månedlig leie er påkrevd.',
            'monthly_rent.numeric'  => 'Feltet månedlig leie må være numerisk.',
            'deposit.required'  => 'Feltet innskudd er påkrevd.',
            'deposit.numeric'  => 'Feltet innskudd må være numerisk.',
            'rented_from.required'  => 'Feltet leies fra er påkrevd.',
            'rented_from.date'  => 'Feltet leies fra må være dato',
            'rented_to.required'  => 'Feltet leid ut til er påkrevd.',
            'rented_to.date'  => 'Feltet leid ut til må være dato',
            'published_on.required'  => 'Feltet publisert den er påkrevd.',
        ];
    }
}
