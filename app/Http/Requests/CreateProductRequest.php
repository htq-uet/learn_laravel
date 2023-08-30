<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class CreateProductRequest extends FormRequest
{
    public function authorize() : bool
    {
        return true;
    }

    public function rules() : array
    {
        return [
            'name' => [
                'required',
                'unique:product,name'
            ],
            'price' => [
                'required',
                'numeric'],
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
