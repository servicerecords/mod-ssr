<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VerifyRequestSave extends FormRequest
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
            'certificate' => 'required|file|mimes:jpeg,png,pdf'
        ];
    }

    public function messages()
    {
        return [
            'certificate.required' => 'Please upload a death certificate',
            'certificate.mimes' => 'Please upload a valid file type'
        ];
    }
}
