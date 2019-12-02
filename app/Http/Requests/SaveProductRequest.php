<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SaveProductRequest extends Request
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
            'name'          => 'required|max:80|min:4',
            'description'   => 'required|min:10',
            'extract'       => 'required|max:150|min:10',
            'price'         => 'required|min:1|numeric',
            'category_id'   => 'required'
        ];
    }
}
