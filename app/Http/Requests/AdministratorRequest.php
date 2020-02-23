<?php

namespace App\Http\Requests;

use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdministratorRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'type' => 'in:administrador,staff',
            'name' => 'required|min:3|max:49',
            'mother_surname' => 'min:3|max:39',
            'father_surname' => 'required|min:4|max:39',
            'password' => 'min:8|max:19|confirmed',
            'email' => [
                'required',
                'min:8',
                'max:69',
                'email',
                'string',
                Rule::unique('users', 'email')->ignore($this->administration)
            ],
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
