<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class DateRequest extends FormRequest
{
    public function authorize() : bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'year' => [
                'integer',
                'min:2000',
                'max:3000'
            ],
            'month' => [
                'integer',
                'min:1',
                'max:12'
            ],
            'day' => [
                'integer',
                'min:1',
                'max:31'
            ],
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new ValidationException($validator, response()->json([
            'success' => false,
            'message' => $validator->messages()->first(),
        ]));
    }
}
