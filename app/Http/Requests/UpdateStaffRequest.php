<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class UpdateStaffRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id' => [
                'required',
                'integer',
            ],
            'name' => [
                'string',
            ],
            'phone' => [
                'string',
                'size:10',
                'unique:staff',
                'regex:/^([0-9\s\-\+\(\)]*)$/',
            ],
            'status' => [
                'string',
                'in:active,deactivated',
            ],
            'password' => [
                'string',
                'min:6',

            ],
        ];
    }

    public function failedValidation(Validator $validator) : void
    {
        throw new ValidationException($validator, response()->json([
            'success' => false,
            'message' => $validator->messages()->first(),
        ]));
    }

}
