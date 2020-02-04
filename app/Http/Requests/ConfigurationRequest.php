<?php

namespace App\Http\Requests;

use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ConfigurationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'domain' => [
                'required',
                'min:7',
                'max:80',
                'string',
                Rule::unique('configurations', 'domain')->ignore($this->configuration)
            ],
            'name' => [
                'required',
                'min:4',
                'max:100',
                'string',
                Rule::unique('configurations', 'name')->ignore($this->configuration)
            ],
            'business_name' => 'required|min:6|max:150|string',
            'slogan' => 'min:6|max:255|string',
            'email' => [
                'required',
                'min:7',
                'max:80',
                'email',
                'string',
                Rule::unique('configurations', 'email')->ignore($this->configuration)
            ],
            'phone' => [
                'required',
                'min:8',
                'max:15',
                Rule::unique('configurations', 'phone')->ignore($this->configuration)
            ],
            'logo' => 'min:6|max:100',
            'type' => 'min:8|max:11',
            'base' => 'min:100',
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
