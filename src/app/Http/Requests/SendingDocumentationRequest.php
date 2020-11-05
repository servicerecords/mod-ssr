<?php

namespace App\Http\Requests;


class SendingDocumentationRequest extends DigitalRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'death-certificate' =>'required|file|max:10000|mimes:jpeg,png,pdf|mimetypes:image/jpeg,image/png,image/bmp,application/pdf'
        ];
    }

    /**
     * @inheritdoc
     */
    public function messages()
    {
        return [
            'death-certificate.required' => 'A death certificate is required',
            'death-certificate.mimes' => 'Your document is not an accepted file type',
            'death-certificate.mimetypes' => 'Your document is not an accepted file type',
            'death-certificate.max' => 'Your file must not be greater than 10Mb'
        ];
    }
}
