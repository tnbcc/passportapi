<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AdminLoginRequest;
use App\Repositories\RolesRepository;
use App\Services\AdminsService;
use Illuminate\Http\Request;

class AdminsController extends BaseController
{
    protected $adminsService;

    protected $rolesRepository;

    /**
     * AdminsController constructor.
     * @param AdminsService $adminsService
     * @param RolesRepository $rolesRepository
     */
    public function __construct(AdminsService $adminsService,RolesRepository $rolesRepository)
    {
        $this->adminsService = $adminsService;

        $this->rolesRepository = $rolesRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $admins = $this->adminsService->getAdminsWithRoles();

        return $this->view(null, compact('admins'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $roles = $this->rolesRepository->getRoles();

        return view('admin.admins.create', compact('roles'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->adminsService->create($request);

        flash('添加管理员成功')->success()->important();

        return redirect()->route('admins.index');
    }


    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $admin = $this->adminsService->ById($id);

        $roles = $this->rolesRepository->getRoles();

        return view('admin.admins.edit', compact('admin','roles'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request,$id)
    {
        $this->adminsService->update($request,$id);

        flash('更新资料成功')->success()->important();

        return redirect()->route('admins.index');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $admin = $this->adminsService->ById($id);

        if(empty($admin))
        {
            flash('删除失败')->error()->important();

            return redirect()->route('admins.index');
        }


        $admin->roles()->detach();

        $admin->delete();


        flash('删除成功')->success()->important();

        return redirect()->route('admins.index');
    }

    /**
     * @param $status
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function status($status,$id)
    {
        $admin = $this->adminsService->ById($id);

        if(empty($admin))
        {
            flash('操作失败')->error()->important();

            return redirect()->route('admins.index');
        }

        $admin->update(['status'=>$status]);

        flash('更新状态成功')->success()->important();

        return redirect()->route('admins.index');
    }

    public function showLoginForm(Request $request)
    {
        return view('admin.admins.login');
    }

    /**
     * @param AdminLoginRequest $request
     */
    public function loginHandle(AdminLoginRequest $request)
    {
       return $this->adminsService->login($request->all());
    }
}
