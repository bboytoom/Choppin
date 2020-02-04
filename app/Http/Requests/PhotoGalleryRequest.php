<?php

namespace App\Http\Requests;

use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PhotoGalleryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'gallery_id' => 'required|exists:App\Models\Gallery,id',
            'name' => [
                'required',
                'min:3',
                'max:100',
                Rule::unique('photo_galleries', 'name')->ignore($this->photosgallery)
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
