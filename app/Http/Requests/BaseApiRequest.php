<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class BaseApiRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    protected function failedValidation(Validator $validator)
    {
        if (request()->is('api/*')) {
            throw new HttpResponseException(response()->json(
                ['success' => false, 'message' => $validator->errors()->first()]
                , 422));
        } else {
            return parent::failedValidation($validator);
        }
    }

}
