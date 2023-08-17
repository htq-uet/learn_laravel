<?php

namespace App\Http\Requests\Auth;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // return auth()->user()->can('create', User::class);
        return true;
    }

    public function rules()
    {

        return [

            'name' => [
                'required',
                'string',
                'min:3',
                'unique:shop',
                'max:255'
            ],
            'address' => [
                'required',
                'string',
                'min:3',
                'max:255'
            ],
            'phone' => [
                'required',
                'string',
                'unique:shop',
                'min:8',
                'max:20'
            ],
            'username' => [
                'required',
                'string',
                'unique:user',
                'min:6',
            ],
            'password' => [
                'required',
                'string',
                'min:8'
            ],
//            'confirm_password' => [
//                'required',
//                'string',
//                'min:6',
//                'same:password'
//            ],
            'role' => [
                'required',
                'string',
                'in:SHOP, STAFF'
            ]

        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new ValidationException($validator, response()->json([
            'success' => false,
            'message' => $validator->messages()->first(),
        ]));
    }
}
