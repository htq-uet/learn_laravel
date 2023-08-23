<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class CreateStaffRequest extends FormRequest
{
    public function authorize() : bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'max:255'
            ],
            'phone' => [
                'required',
                'string',
                'unique:staff',
                'regex:/^([0-9\s\-\+\(\)]*)$/',
                'min:10'
            ],
            'username' => [
                'required',
                'string',
                'unique:user',
                'max:255'
            ],
            'password' => [
                'required',
                'string',
                'min:6'
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
