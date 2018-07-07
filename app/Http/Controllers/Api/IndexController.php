<?php

namespace App\Http\Controllers\Api;

class IndexController extends ApiController
{
    public function index(){

        return $this->message('请求成功');
    }
}