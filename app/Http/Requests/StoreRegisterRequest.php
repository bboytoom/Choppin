<?php

namespace App\Http\Requests;

use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;

class StoreRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:50|min:3',
            'father_surname' => 'required|string|max:30|min:4',
            'mother_surname' => 'max:30|string|min:4',
            'email' => 'required|email|max:80|min:6|unique:users',
            'password'  => 'required|string|min:8|max:20|confirmed'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        
        throw new HttpResponseException(response()->json(
            [
                'errors' => $errors
            ], 
            JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
