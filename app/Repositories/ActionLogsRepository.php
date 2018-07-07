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


use App\Models\ActionLog;

class ActionLogsRepository
{
    /**
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        return ActionLog::create($data);
    }

    /**
     * 获取全部的操作日志
     * @return mixed
     */
    public function getWithAdminActionLogs()
    {
        return ActionLog::with('admin')->latest('created_at')->paginate(20);
    }
}