<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SaveUserRequest extends Request
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
            'name'      => 'required|max:50|min:3',
            'father_surname' => 'required|max:30|min:4',
            'mother_surname' => 'max:30|min:4',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|confirmed',
            'type'      => 'required|in:user,admin'
        ];
    }
}
