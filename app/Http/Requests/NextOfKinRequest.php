<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NextOfKinRequest extends FormRequest
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
            'next_of_kin' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'next_of_kin.required' => 'Please tell us if you are the next of kin'
        ];
    }
}
