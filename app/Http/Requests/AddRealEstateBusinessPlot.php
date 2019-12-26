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
}
