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
//            'number_of_tenants' => 'sometimes|nullable|numeric',
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
      public function messages()
    {
        return [
            'ad_headline.required' => 'Feltet overskrift er påkrevd.',
            'zip_code.required'  => 'Feltet post kode er påkrevd.',
            'zip_code.numeric'  => 'Feltet post kode må være numerisk.',
            'location.required' => 'Plasseringsfeltet er påkrevd.',
            'property_type.required'  => 'Feltet Eiendomstype er påkrevd.',
            'tenure.required'  => 'Feltet Eiendomstype er påkrevd.',
            'muncipal_number.required'  => 'Kommunenummerfeltet er påkrevd.',
            'muncipal_number.numeric'  => 'Kommunenummerfeltet må være numerisk.',
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
            'housing_area.numeric'  => 'Boligområdet må være numerisk.',
            'primary_room.required'  => 'det primære romfeltet er påkrevd.',
            'primary_room.numeric'  => 'primærrommet må være numerisk.',
           'gross_area.numeric' => 'Bruttoområdet må være numerisk.',
            'Base.numeric'  => 'basefeltet må være numerisk.',
            'year.required'  => 'årsfilen er påkrevd..',
            'year.numeric'  => 'årsfeltet må være numerisk.',
            'renovated_year.numeric'  => 'det renoverte årsfeltet må være numerisk.',
            'number_of_bedrooms.required'  => 'antall soveromsfiler er påkrevd.',
            'number_of_bedrooms.numeric'  => 'antall felt må være numerisk.',
            'number_of_beds.numeric'  => 'the number of beds fields must be numeric.',
            'number_of_rooms.numeric'  => 'antall romfelt må være numeriske.',
            'number_of_parking_spaces.numeric'  => 'the number of parking spaces must be numeric.',
            'floor.numeric'  => 'gulvfeltet må være numerisk.',
            'land.numeric'  => 'landfeltet må være numerisk.',
//            'number_of_tenants.numeric'  => 'antall leietakere må være numerisk.',
            'joint_board_after_interest_fee_period.numeric'  => 'fellesstyret etter rentegebyrperioden må være numerisk.',
            'holiday_year.numeric'  => 'ferieåret må være numerisk.',
            'party_fee.numeric'  => 'festgebyrfeltet må være numerisk.',
            'rent_shared_cost.required'  => 'Filen med leiekostnad kreves.',
            'rent_shared_cost.numeric'  => 'feltet med leiekostnad må være numerisk.',
            'shared_costs_include.required'  => 'de delte kostnadene inkluderer fil er påkrevd.',
            'common_costs_after_interest_free_period.numeric'  => 'felleskostnadene etter rentefri periode må være numeriske.',
            'asset_value.required'  => 'verdifeltet er obligatorisk.',
            'asset_value.numeric'  => 'aktiva-feltet må være numerisk.',
            'cost.numeric'  => 'aktiva-feltet må være numerisk.',
            'asking_price.required'  => 'den anmodede prisen er påkrevd.',
            'asking_price.numeric'  => 'spørringsprisfeltet må være numerisk.',
            'expenses.required'  => 'de innleverte utgiftene kreves.',
            'expenses.numeric'  => 'Utgiftsfeltet må være numerisk.',
            'cost_includes.required'  => 'kostnadene inkluderer innleverte er påkrevd.',
            'cost_includes.numeric'  => 'kostnadene inkluderer felt må være numeriske.',
            'prcentage_of_joint_debt.required'  => 'prosentandel av offentlig gjeldsfelt kreves.',
            'prcentage_of_joint_debt.numeric'  => 'prosentandelen av offentlig gjeldsfelt må være numerisk.',
            'value_rate.numeric'  => 'målsettingsfeltet må være numerisk.',
            'loan_rate.numeric'  => 'belastningsfeltet må være numerisk.',
            'total_price.numeric'  => 'det totale prisfeltet må være numerisk.',
            'percentage_of_common_health.numeric'  => 'belastningsfeltet må være numerisk.',
            'muncipal_fees_per_year.numeric'  => 'Feltet for kommunale avgifter per år må være numerisk.',
            'asset_value.numeric'  => 'Formuesverdien må være numerisk.',
            'common_costs.numeric'  => 'Formuesverdien må være numerisk.',

        ];
    }
}
