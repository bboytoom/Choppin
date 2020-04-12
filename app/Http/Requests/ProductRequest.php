<?php

namespace App\Http\Requests;

use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'subcategory_id' => 'required|exists:App\Models\Subcategory,id',
            'name' => [
                'required',
                'min:3',
                'max:99',
                'string',
                Rule::unique('products', 'name')->ignore($this->product)
            ],
            'extract' => 'required|min:4|max:99',
            'description' => 'required|min:4|max:399',
            'price' => 'required|max:6',
            'stock' => 'required|max:3',
            'status' => 'boolean'
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
