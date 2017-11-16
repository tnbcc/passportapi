<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class RbacAuth
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /**判断登录用户是否已经登录*/
        if(!Auth::guard('admin')->check())
        {
            return redirect()->route('login');
        }

        /**获取当前访问的路由地址*/
        $path = $request->path();

        /**获取当前登录用户的信息*/

        $user = Auth::guard('admin')->user();

        $permissions = [];

        foreach($user->roles as $role)
        {
            $permissions = array_unique(array_merge($permissions, $role->rules()->pluck('route')->toArray()));
        }

        if(!in_array($path, $permissions))
        {
            return viewError('你无权访问!','index.index');
        }

        return $next($request);
    }
}
