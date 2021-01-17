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
            'death-certificate' => 'required|file|max:50000|mimes:jpeg,png,pdf|mimetypes:image/jpeg,image/png,image/bmp,application/pdf'
        ];
    }

    /**
     * @inheritdoc
     */
    public function messages()
    {
        return [
            'death-certificate.required' => 'Select a death certificate',
            'death-certificate.mimes' => 'The selected file must be a JPG, PNG or PDF',
            'death-certificate.mimetypes' => 'The selected file must be a JPG, PNG or PDF',
            'death-certificate.max' => 'The selected file must be smaller than 50Mb'
        ];
    }
}
