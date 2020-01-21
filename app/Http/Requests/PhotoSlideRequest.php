<?php

namespace App\Http\Requests;

use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PhotoSlideRequest extends FormRequest
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
            'configuration_id' => 'required|exists:App\Models\Configuration,id',
            'name' => [
                'required',
                'min:3',
                'max:100',
                Rule::unique('photo_slides', 'name')->ignore($this->photoslide)
            ],
            'image' => 'min:6|max:100',
            'type' => 'min:8|max:11',
            'base' => 'min:100',
            'description' => 'min:4|max:255',
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