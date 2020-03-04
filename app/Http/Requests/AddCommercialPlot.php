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
            'contact'               => 'required',
            'e_post'               => 'required',
        
        ];
    }
}
