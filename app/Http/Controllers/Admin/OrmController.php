<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\Rule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrmController extends Controller
{
    public function index()
    {
        //从记录中获取单个值
       // $starus = Admin::where('id','2')->value('status');

        //获取指定一列的值
       // $status = Admin::pluck('status');

       /*Rule::orderBy('id')->chunk(5,function ($rules){
           foreach ($rules as $rule) {
           echo '<pre>';
           print_r($rule);
           }
       });*/
       //确定记录是否存在
      /*$a = Admin::where('id',2)->exists();
        echo '<pre>';
        var_dump($a);*/
      $rules = Rule::where('id',1)
                 ->orWhere('name','删除')
                 ->get();
      echo '<pre>';
      print_r($rules);
    }
}
