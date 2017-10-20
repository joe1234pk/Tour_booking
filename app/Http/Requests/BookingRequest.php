<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
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
        $rules =[
            //
            'tour_date' =>'required|date'
        ];

        if($this->request->get('passengers'))
        {
            //$i = 0;
            foreach($this->request->get('passengers') as $key=>$passengers)
            {
                $rules['passengers.'.$key.'.given_name'] ='required';
                $rules['passengers.'.$key.'.surname'] ='required';
                $rules['passengers.'.$key.'.email'] ='required|email';
                $rules['passengers.'.$key.'.mobile'] ='required|numeric';
                $rules['passengers.'.$key.'.passport'] ='required';
                $rules['passengers.'.$key.'.birth_date'] ='required|date';
                //$i++;
            }
        }

        if($this->request->get('new_passengers'))
        {

               for($i=0;$i<count($this->request->get('new_passengers')['given_name']);$i++)
             {
                  $rules['new_passengers.'.'given_name.'.$i] = 'required';
                  $rules['new_passengers.'.'surname.'.$i] ='required';
                  $rules['new_passengers.'.'email.'.$i] ='required|email';
                  $rules['new_passengers.'.'mobile.'.$i] ='required|numeric';
                  $rules['new_passengers.'.'passport.'.$i] ='required';
                  $rules['new_passengers.'.'birth_date.'.$i] ='required|date';
                }
        

            }
        return $rules;
    }
}
