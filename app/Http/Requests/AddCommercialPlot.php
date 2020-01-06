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
            'location_description'  => 'required',
            'location_description'  => 'required',
            'municipal_number'      => 'sometimes|nullable|numeric',
            'usage_number'          => 'required|numeric',
            'farm_number'           => 'required|numeric',
            'plot_size'             => 'required|numeric',
            'asking_price'          => 'required|numeric',
            'verditakst'            => 'required|numeric',
            'headline'              => 'required',
            'link'                  => 'required',
            'text_for_information'  => 'required',
            'phone'                 => 'sometimes|nullable|numeric',
            'contact'               => 'required',
            'e_post'               => 'required',
        
        ];
    }
}
