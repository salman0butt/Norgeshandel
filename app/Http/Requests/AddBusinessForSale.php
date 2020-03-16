<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddBusinessForSale extends FormRequest
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
            'industry' => 'required',
            'country' => 'required',
            'zip_code' => 'required',
            'headline' => 'required',

        ];
    }
           public function messages()
    {
        return [
            'headline.required' => 'Overskriftfeltet er påkrevd.',
            'country.required' => 'Landsfeltet er påkrevd.',
            'zip_code.required' => 'Postnummerfeltet er påkrevd.',
            'industry.required' => 'Bransjefeltet er påkrevd.',
        ];
    }
}
