<?php
/**
 * YICMS
 * ============================================================================
 * 版权所有 2014-2017 YICMS，并保留所有权利。
 * 网站地址: http://www.yicms.vip
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * Created by PhpStorm.
 * Author: kenuo
 * Date: 2017/11/14
 * Time: 下午6:00
 */

namespace App\Services;


class AdminAuth
{
    public static $id;

    public static $session = 1;

    public function __construct()
    {
        $this->session = session('admin_auth');
    }

    /**
     * 判断是否已经登录
     * @return bool
     */
    static public function checked()
    {
        return !! self::$session;
    }
}