<?php

/**
 * 后台路由
 */

Route::group(['namespace' => 'Admin','prefix' => 'admin'], function (){

    Route::resource('index', 'IndexsController', ['only' => ['index']]);  //首页

    Route::get('index/main', 'IndexsController@main')->name('index.main'); //首页数据分析
});
