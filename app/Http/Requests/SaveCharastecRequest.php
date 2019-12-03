<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SaveCharastecRequest extends Request
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
            'caracteristica' => 'required|min:4|max:50',
            'descripcion' => 'required|min:4'
        ];
    }
}
