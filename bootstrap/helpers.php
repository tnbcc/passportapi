<?php

/**
 * @return mixed
 */
function route_class()
{
    return str_replace('.', '-', Route::currentRouteName());
}

/**
 * 给浏览器静态资源加版本号,强制刷新缓存
 * @param  string $source 资源路径
 * @return string         资源路径加上版本号
 */
function loadEdition($source)
{
    $version = '1.00';

    return $source . '?v=' . $version;
}

/**
 * 返回错误信息页面提示
 * @param null $message
 * @param null $url
 * @param null $view
 * @return \Illuminate\Http\Response
 */
function viewError($message = null, $url = null, $view = null, $wait = 3)
{
    $view = $view ? $view : 'admin.errors.error';

    return response()->view($view,[
        'url'=> $url ? $url : '/',
        'message'=>$message ? $message : '发生错误,请重试!',
        'wait' => $wait,
    ]);
}