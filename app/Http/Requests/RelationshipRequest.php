<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RelationshipRequest extends FormRequest
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
            'relationship' => 'required',
			'relationship_other' => 'required_if:relationship,Other',
            'next_of_kin' => 'required'
        ];
    }

    public function messages()
	{
		return [
			'relationship.required' => 'Please specify what you relationship is with the serviceperson',
			'relationship_other.required_if' => 'Please specify your relationship with the serviceperson',
            'next_of_kin.required' => 'Please specify if you are the immediate next of kin'
		];
	}
}
