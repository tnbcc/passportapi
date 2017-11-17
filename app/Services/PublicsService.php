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
 * Date: 2017/11/17
 * Time: 下午4:42
 */

namespace App\Services;


class PublicsService
{
    /**
     * 获取id详细地址信息
     * @param null $id
     * @return mixed
     */
    public function getLocation($id = null)
    {
        return \Ip::find($id);
    }
}