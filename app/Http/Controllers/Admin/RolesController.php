<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use Illuminate\Http\Request;

class RolesController extends BaseController
{
    /**
     * 展示所有角色
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request , Role $role)
    {
        $roles = $role->paginate(30);

        return $this->view(null,compact('roles'));
    }

    /**
     * 展示角色页面
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->view();
    }

    /**
     * 添加角色
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Role $role)
    {
        $role->fill($request->all());
        $role->save();

        flash('添加角色成功')->success()->important();

        return redirect()->route('roles.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return $this->view('edit',compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $role->update($request->all());
        flash('修改成功')->success()->important();

        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();
        flash('删除成功')->success()->important();

        return redirect()->route('roles.index');
    }

    public function access($id)
    {

    }
}
