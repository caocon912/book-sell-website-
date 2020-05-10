<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserInfoRequest extends FormRequest
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
            'username'=>'required|max:20|unique:user',
            'email'=>'required|email:rfc,dns,filter|unique:user',
            'pwd'=>'required|min:6|max:20',
            're-pwd'=>'required|same:pwd|min:6|max:20'
        ];
    }

    public function messages(){
        return [
            'username.unique' => 'Username is exists.',
            'email.unique' => 'Email already has an account .',
            'pwd.min' => 'Password must be at least 6 characters.',
            'pwd.max' => 'Password only allows 20 characters.',
            'pwd.required' => 'Password is required.',
            're-pwd.same' => 'Password does not match.',
            're-pwd.required' => 'Re-Password is required.',
        ];
    }
}
