<?php

namespace App\Http\Requests\Api;


class AuthenticateRequest extends Request
{

    public function rules()
    {
        return [
            'phone' => 'required',
            'password' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'phone.required' => '手机不能为空',
            'password.required' => '密码不能为空',
        ];
    }
}
