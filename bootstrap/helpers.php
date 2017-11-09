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