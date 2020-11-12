<?php

namespace App\Http\Requests;

use App\Models\Constant;


class ApplicantRelationshipRequest extends DigitalRequest
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
            'applicant-relationship' => 'required',
            'applicant-relationship-other' => 'required_if:applicant-relationship,' . Constant::RELATION_OTHER,
        ];
    }

    /**
     * @inheritdoc
     */
    public function messages()
    {
        return [
            'applicant-relationship.required' => 'Specify your relationship to the serviceperson',
            'applicant-relationship-other.required_if' => 'Specify your relationship with the serviceperson'
        ];
    }
}
