<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class CreateOrderRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules() {
        return [
            'product_ids' => [
                'required',
                'array',
                'min:1'
            ],
//            'product_ids.*' => [
//                'required',
//                'exists:product,id'
//            ],
            'product_ids.*.quantity' => [
                'required',
                'integer',
                'min:1'
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
