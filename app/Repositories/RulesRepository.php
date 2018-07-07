<?php
/**
 * passport
 * ============================================================================
 * 版权所有 2018-2019 passport，并保留所有权利。
 * 网站地址: http://www.laraveltalk.top
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * Created by PhpStorm.
 * Author: nbc
 * Date: 2018/07/07
 * Time: 上午9:50
 */

namespace App\Repositories;


use App\Models\Rule;

class RulesRepository
{
    /**
     * 添加权限
     * @param array $params
     * @return mixed
     */
    public function create(array $params)
    {
        return Rule::create($params);
    }

    /**
     * 根据id获取权限的详细信息
     * @param $id
     * @return mixed
     */
    public function ById($id)
    {
        return Rule::find($id);
    }

    /**
     * 根据路由名称获取路由的详细信息
     * @param $route
     * @return mixed
     */
    public function ByRoute($route)
    {
        return Rule::where('route',$route)->first();
    }

    /**
     * 获取全部权限只限显示的数据
     * @return mixed
     */
    public function getRulesAndPublic()
    {
        return Rule::orderBy('sort','asc')->public()->get();
    }

    /**
     * 获取全部权限
     * @return mixed
     */
    public function getRules()
    {
        return Rule::orderBy('sort','asc')->get();
    }
}