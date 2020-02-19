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
            'costs_include' => 'required',
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
            'headline.required' => 'Feltet overskrift er påkrevd.',
            'zip_code.required'  => 'Feltet post kode er påkrevd.',
            'zip_code.numeric'  => 'Feltet post kode må være numerisk.',
            'street_address.required'  => 'Feltet gateadresse er påkrevd.',
            'property_type.required'  => 'Feltet Eiendomstype er påkrevd.',
            'tenure.required'  => 'Feltet Eiendomstype er påkrevd.',
            'municipality_number.required'  => 'Kommunenummerfeltet er påkrevd.',
            'municipality_number.numeric'  => 'Kommunenummerfeltet må være numerisk.',
            'primary_rom.required'  => 'Feltet primærrom er påkrevd.',
            'primary_rom.numeric'  => 'Feltet primærrom må være numerisk.',
            'farm_number.required'  => 'Gårdsnummerfeltet er påkrevd.',
            'farm_number.numeric'  => 'Feltet primærrom må være numerisk.',
            'usage_number.required'  => 'Bruksnummerfeltet er påkrevd.',
            'usage_number.numeric'  => 'Bruksnummerfeltet må være numerisk.',
            'party_number.required'  => 'partinummerfeltet er påkrevd.',
            'party_number.numeric'  => 'partinummerfeltet må være nummer.',
            'section_number.required'  => 'seksjonsnummerfeltet er påkrevd.',
            'section_number.numeric'  => 'seksjonsnummerfeltet må være nummer.',
            'apartment_number.numeric'  => 'Leilighetsnummerfeltet må være numerisk.',
            'use_area.required'  => 'feltet for bruk er obligatorisk.',
            'use_area.numeric'  => 'Bruksområdefeltet må være numerisk.',
            'primary_room.required'  => 'det primære romfeltet er påkrevd.',
            'primary_room.numeric'  => 'primærrommet må være numerisk.',
            'Base.numeric'  => 'basefeltet må være numerisk.',
            'year.required'  => 'årsfilen er påkrevd..',
            'year.numeric'  => 'årsfeltet må være numerisk.',
            'renovated_year.numeric'  => 'det renoverte årsfeltet må være numerisk.',
            'number_of_bedrooms.required'  => 'antall soveromsfiler er påkrevd.',
            'number_of_bedrooms.numeric'  => 'antall felt må være numerisk.',
            'number_of_rooms.numeric'  => 'antall romfelt må være numeriske.',
            'floor.numeric'  => 'gulvfeltet må være numerisk.',
            'land.numeric'  => 'landfeltet må være numerisk.',
            'holiday_year.numeric'  => 'ferieåret må være numerisk.',
            'party_fee.numeric'  => 'festgebyrfeltet må være numerisk.',
            'rent_shared_cost.required'  => 'Filen med leiekostnad kreves.',
            'rent_shared_cost.numeric'  => 'feltet med leiekostnad må være numerisk.',
            'shared_costs_include.required'  => 'de delte kostnadene inkluderer fil er påkrevd.',
            'common_costs_after_interest_free_period.numeric'  => 'felleskostnadene etter rentefri periode må være numeriske.',
            'asset_value.required'  => 'verdifeltet er obligatorisk.',
            'asset_value.numeric'  => 'aktiva-feltet må være numerisk.',
            'asking_price.required'  => 'den anmodede prisen er påkrevd.',
            'asking_price.numeric'  => 'spørringsprisfeltet må være numerisk.',
            'expenses.required'  => 'de innleverte utgiftene kreves.',
            'expenses.numeric'  => 'Utgiftsfeltet må være numerisk.',
            'costs_include.required'  => 'kostnadene inkluderer innleverte er påkrevd.',
            'costs_include.numeric'  => 'kostnadene inkluderer felt må være numeriske.',
            'percentage_of_public_debt.required'  => 'prosentandel av offentlig gjeldsfelt kreves.',
            'percentage_of_public_debt.numeric'  => 'prosentandelen av offentlig gjeldsfelt må være numerisk.',
            'value_rate.numeric'  => 'målsettingsfeltet må være numerisk.',
            'loan_rate.numeric'  => 'belastningsfeltet må være numerisk.',
            'percentage_of_common_wealth.numeric'  => 'belastningsfeltet må være numerisk.',
            'muncipal_fees_per_year.numeric'  => 'Feltet for kommunale avgifter per år må være numerisk.',

        ];
    }
}
