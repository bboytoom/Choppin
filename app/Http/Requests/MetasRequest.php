<?php

namespace App\Http\Requests;

use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MetasRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'configuration_id' => 'required|exists:App\Models\Configuration,id',
            'keyword' => 'required|min:3|max:254',
            'description' => 'required|min:3|max:254'
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
