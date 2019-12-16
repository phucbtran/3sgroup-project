<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyOverviewRequest extends FormRequest
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
            'logo_dir_path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'address' => 'required|max:500',
            'email' => 'required|email|max:500',
            'phone' => 'required|max:50',
            'skype' => 'max:500',
            'facebook' => 'max:1024',
            'map_api' => 'required|max:1024',
            'head_description' => 'required',
            'detail_description' => 'required',
            'img_detail_dir_path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
        ];
    }
}
