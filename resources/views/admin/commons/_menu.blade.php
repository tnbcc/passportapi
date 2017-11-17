<!--左侧导航开始-->
<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="nav-close"><i class="fa fa-times-circle"></i>
    </div>
    <div class="sidebar-collapse">
        <ul class="nav" id="side-menu">
            <li class="nav-header text-center">
                <div class="dropdown profile-element">
                        <span><img alt="image" class="img-circle" src="{{Auth::guard('admin')->user()->avatr}}"
                                   width="64"/></span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="clear">
                               <span class="block m-t-xs"><strong
                                           class="font-bold">{{Auth::guard('admin')->user()->name}}</strong></span>
                                  <span class="text-muted text-xs block">
                                    @foreach(Auth::guard('admin')->user()->roles as $role)
                                          {{$role->name}}<b class="caret"></b>
                                      @endforeach
                                  </span>
                                </span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a class="J_menuItem" href="form_avatar.html">修改头像</a></li>
                        <li><a class="J_menuItem" href="form_avatar.html">修改密码</a></li>
                        <li class="divider"></li>
                        <li><a href="{{route('admin.logout')}}">安全退出</a></li>
                    </ul>
                </div>
                <div class="logo-element">YS+</div>
            </li>

            <li><a title="网站首页" href="/" target="_blank"> <i class="fa fa-home"></i> <span
                            class="nav-label">网站首页</span></a></li>
            <li>
                <a title="权限管理"> <i class="fa fa-user"></i> <span class="nav-label">权限管理</span> <span
                            class="fa arrow"></span> </a>
                <ul class="nav nav-second-level collapse">
                    <li><a class="J_menuItem" href="{{ route('admins.index') }}" data-index="14">管理员</a></li>
                    <li><a class="J_menuItem" href="{{ route('roles.index') }}" data-index="14">角色管理</a></li>
                    <li><a class="J_menuItem" href="{{ route('rules.index') }}" data-index="14">权限管理</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
<!--左侧导航结束-->