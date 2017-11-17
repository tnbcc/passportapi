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
 * Time: 下午2:30
 */
namespace App\Models\Traits;

use Cache;

trait RbacCheck
{
    // 缓存相关配置
    protected $cache_key = '_cache_rules';

    /**
     * 获取当前用户的所有权限
     * @return array
     */
    public function getRules()
    {
        $cache_key = $this->id . $this->cache_key;

        if(Cache::has($cache_key)){
            return Cache::get($cache_key);
        }

        $permissions = [];

        foreach ($this->roles as $role)
        {
            $permissions = array_merge($permissions, $role->rules()->pluck('route')->toArray());
        }

        /**获得当前用户所有权限路由*/
        $permissions = array_unique($permissions);

        /**将权限路由存入缓存中*/
        Cache::forever($this->id . $this->cache_key,$permissions);

        return $permissions;
    }

    /**
     * 删除某个用户的权限缓存
     * @return mixed
     */
    public function clearRules()
    {
        return Cache::forget($this->id . $this->cache_key);
    }
}