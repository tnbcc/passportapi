<?php

/**
 * 后台路由
 */

Route::group(['namespace' => 'Admin','prefix' => 'admin'], function (){

    Route::resource('index', 'IndexsController', ['only' => ['index']]);  //首页

    Route::get('index/main', 'IndexsController@main')->name('index.main'); //首页数据分析

    Route::get('admins/status/{statis}/{admin}','AdminsController@status')->name('admins.status');

    Route::resource('admins','AdminsController',['only' => ['index', 'create', 'store', 'update', 'edit', 'destroy']]); //管理员

    Route::resource('roles','RolesController',['only'=>['index','create','store','update','edit','destroy'] ]);  //角色

    Route::get('rules/status/{status}/{rules}','RulesController@status')->name('rules.status');

    Route::resource('rules','RulesController',['only'=> ['index','create','store','update','edit','destroy'] ]);  //权限
});
