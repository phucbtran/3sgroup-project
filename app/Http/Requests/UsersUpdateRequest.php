<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UsersUpdateRequest extends FormRequest
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
            'full_name' => 'required|max:500',
            'email' => 'required|email|max:500|unique:users,email,'.$this->route()->id,
            'password' => 'max:500',
            'status' => 'in:0,1',
            'role' => 'in:0,1'
        ];
    }

    public function messages()
    {
        return [

        ];
    }
}
