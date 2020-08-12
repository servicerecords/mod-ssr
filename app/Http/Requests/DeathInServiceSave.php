<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeathInServiceSave extends FormRequest
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
            'death' => 'required'
        ];
    }

    /**
     * Get the validation messages that apply to the request
     *
     * @return array
     */
    public function messages()
    {
        return [
            'death.required' => 'Please state if they died in service'
        ];
    }
}
