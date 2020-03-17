<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddRealEstateBusinessPlot extends FormRequest
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
                'type_plot' => 'required',
                'location' => 'required',
                'zip_code' => 'required',
                'location_description'   => 'required|numeric',
                'muncipal_number'   => 'sometimes|nullable|numeric',
                'usage_number'   => 'required',
                'farm_number'   => 'required',
                'plot_size'   => 'required',
                'facilities' => 'required',
                'asking_price' => 'required',
                'valuation1' => 'required',
                'valuation2' => 'required',
                'head_line' => 'required',
                'text_on_link' => 'required',
                'link_for_information' => 'required',
                'contact' => 'required',
                'email' => 'required',
                'published-on' => 'required',
        ];
    }
           public function messages()
    {
        return [
            'head_line.required' => 'Topptekstfeltet er obligatorisk.',
            'type_plot.required' => 'Type plottfelt er påkrevd.',
            'location.required' => 'Plasseringsfeltet er påkrevd.',
            'zip_code.required'  => 'Postnummerfeltet er påkrevd.',
            'zip_code.numeric'  => 'Postkodefeltet må være numerisk.',
            'location_description.required'  => 'Stedsbeskrivelsesfeltet er påkrevd.',
            'muncipal_number.numeric'  => 'Feltet muncipal nummer må være numerisk.',
            'usage_number.required'  => 'Bruksnummerfeltet er påkrevd.',
            'usage_number.numeric'  => 'Bruksnummerfeltet må være numerisk.',
            'farm_number.numeric'  => 'Gårdsnummerfeltet må være numerisk.',
            'farm_number.required'  => 'Gårdsnummerfeltet er påkrevd.',
            'plot_size.required'  => 'Tomtestørrelsesfeltet er påkrevd.',
            'facilities.required'  => 'Fasilitetsfeltet er påkrevd.',
            'asking_price.required'  => 'Prisforespørselfeltet er påkrevd.',
            'valuation1.required'  => 'Verdsettelsesfeltet er påkrevd.',
            'valuation2.required'  => 'Verdsettelsesfeltet er påkrevd.',
            'text_on_link.required'  => 'Teksten på lenkefeltet er påkrevd.',
            'contact.required'  => 'Kontaktfeltet er påkrevd.',
            'link_for_information.required'  => 'Koblingen for informasjonsfelt er påkrevd.',
            'email.required'  => 'E-postfeltet er påkrevd.',
            'published-on.required'  => 'Det publiserte på feltet er påkrevd.',
            'zip_code.numeric'  => 'Postkodefeltet må være numerisk.',

        ];
    }
}
