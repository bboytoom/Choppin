<?php

namespace App\Http\Requests;

use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;

class BuyRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'shoppingCart' => 'required',
            'shippingCart' => 'required',
            'paymentId' => 'required|min:25',
            'token' => 'required|min:15',
            'PayerID' => 'required|min:10'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();

        throw new HttpResponseException(
            response()->json(
                [
                'errors' => $errors
            ],
                JsonResponse::HTTP_UNPROCESSABLE_ENTITY
            )
        );
    }
}
