<?php

namespace App\Http\Controllers\Api;
use App\Models\User;
use App\Http\Requests\Api\AuthenticateRequest;
class IndexController extends ApiController
{
    public function index(){

        return $this->message('请求成功');
    }

    public function register(AuthenticateRequest $request)
    {
        $input['password'] = bcrypt($request->password);
        $input['phone'] = $request->phone;
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->accessToken;


        return $this->message('注册成功');
    }
}