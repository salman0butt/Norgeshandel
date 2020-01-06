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

    public function messages()
    {
        return [
            'heading.required' => 'Feltet overskrift er påkrevd.',
            'zip_code.required'  => 'Feltet post kode er påkrevd.',
            'zip_code.numeric'  => 'Feltet post kode må være numerisk.',
            'street_address.required'  => 'Feltet gateadresse er påkrevd.',
            'property_type.required'  => 'Feltet Eiendomstype er påkrevd.',
            'tenure.required'  => 'Feltet Eiendomstype er påkrevd.',
            'municipality_number.required'  => 'Kommunenummerfeltet er påkrevd.',
            'municipality_number.numeric'  => 'Kommunenummerfeltet må være numerisk.',
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
