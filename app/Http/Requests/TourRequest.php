<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TourRequest extends FormRequest
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
        $rules =  [
            //
            'name' =>'required',
            'itinerary' =>'required',
        ];
        if($this->request->get('new_dates'))
        {
        for($i=0;$i<count($this->request->get('new_dates'));$i++)
        {
            $rules['new_dates.'.$i] = 'required';

        }
        }

        return $rules;
    }
}
