<?php


namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Validator;

abstract class DigitalRequest extends FormRequest
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
     * @param Validator $validator
     */
    public function withValidator(Validator $validator)
    {
        if ($validator->fails()) {
            Log::info('VALIDATION_ERROR', $validator->errors()->getMessages());
        }
    }
}
