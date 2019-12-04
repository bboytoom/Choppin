<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SaveUserEnvioRequest extends Request
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
            'calle_uno' => 'required|max:255|min:5',
            'calle_dos' => 'max:254|min:5',
            'direccion' => 'required|max:255|min:10',
            'colonia' => 'required|max:150|min:8',
            'municipio' => 'required|max:150|min:8',
            'estado' => 'required|max:100|min:4',
            'pais' => 'required|max:50|min:4',
            'codigo_postal' => 'required|max:7|min:5'
        ];
    }
}
