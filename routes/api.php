<?php
//Route::post('register', 'Api\RegisterController@register');


Route::group(['namespace' => 'Api'], function (){
    Route::post('register','IndexController@register');
    Route::post('login', 'AuthenticateController@login');
    //Route::middleware('auth:api')->group( function () {
       // Route::resource('products', 'ProductController');
    //});

});
