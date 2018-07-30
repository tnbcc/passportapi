<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cache;
class TestController extends Controller
{
    public function index(Request $request)
    {
        //echo $request->session()->get('sex');
        //Cache::put('sex',1,2);
        echo Cache::get('sex');
    }
}
