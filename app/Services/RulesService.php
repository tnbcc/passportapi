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

namespace App\Services;

use App\Handlers\Tree;
use App\Repositories\RulesRepository;

class RulesService
{
    protected $tree;

    protected $rulesRepository;

    /**
     * RulesService constructor.
     * @param RulesRepository $rulesRepository
     * @param Tree $tree
     */
    public function __construct(RulesRepository $rulesRepository,Tree $tree)
    {
        $this->tree = $tree;

        $this->rulesRepository = $rulesRepository;
    }

    /**
     * 创建权限数据
     * @param array $params
     * @return mixed
     */
    public function create(array $params)
    {
        return $this->rulesRepository->create($params);
    }

    /**
     * 根据id获取权限的详细信息
     * @param $id
     * @return mixed
     */
    public function ById($id)
    {
        return $this->rulesRepository->ById($id);
    }

    /**
     * 获取树形结构权限列表
     * @return array
     */
    public function getRulesTree()
    {
        $rules = $this->rulesRepository->getRules()->toArray();
        return Tree::tree($rules,'name','id','parent_id');
    }
}