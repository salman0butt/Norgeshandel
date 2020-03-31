<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddCommercialPlot extends FormRequest
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
            'plot_type' => 'required',
            'country'   => 'required',
            'zip_code'  => 'required',
            'municipal_number'      => 'sometimes|nullable|numeric',
            'usage_number'          => 'nullable|numeric',
            'farm_number'           => 'nullable|numeric',
            'plot_size'             => 'nullable|numeric',
            'asking_price'          => 'required|numeric',
            'verditakst'            => 'nullable|numeric',
            'headline'              => 'required',
            'phone'                 => 'sometimes|nullable|numeric',
//            'contact'               => 'required',
//            'e_post'               => 'required',
        
        ];
    }
          public function messages()
    {
        return [
            'headline.required' => 'Overskriftfeltet er påkrevd.',
            'plot_type.required' => 'Plottypefeltet er påkrevd.',
            'country.required' => 'Landsfeltet er påkrevd.',
            'zip_code.required' => 'Postnummerfeltet er påkrevd.',
            'location_description.required' => 'Stedsbeskrivelsesfeltet er påkrevd.',
            'municipal_number.numeric' => 'Det kommunale nummerfeltet må være numerisk.',
            'usage_number.numeric' => 'Bruksnummerfeltet må være numerisk.',
            'farm_number.numeric' => 'Gårdsnummerfeltet må være numerisk.',
            'plot_size.numeric' => 'Plottstørrelsesfeltet må være numerisk.',
            'asking_price.numeric' => 'Prisforespørselfeltet må være numerisk.',
            'verditakst.numeric' => 'Verditakst-feltet må være numerisk.',
            'phone.numeric' => 'Telefonfeltet må være numerisk. ',
             'usage_number.required' => 'Bruksnummerfeltet er påkrevd.',
            'farm_number.required' => 'Gårdsnummerfeltet er påkrevd.',
            'plot_size.required' => 'Tomtestørrelsesfeltet er påkrevd.',
            'asking_price.required' => 'Prisforespørselfeltet er påkrevd.',
            'verditakst.required' => 'Verditakst-feltet er påkrevd.',
            'link.required' => 'Koblingsfeltet er påkrevd.',
            'text_for_information.required' => 'Teksten for informasjonsfeltet er obligatorisk.',
//            'contact.required' => 'Kontaktfeltet er påkrevd.',
//            'e_post.required' => 'E-postfeltet er påkrevd.'
        ];
    }
}
