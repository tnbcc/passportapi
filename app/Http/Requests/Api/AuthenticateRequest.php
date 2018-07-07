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
}
