<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="renderer" content="webkit">
  <meta http-equiv="Cache-Control" content="no-siteapp" />
  <title>Ucar360二手车后台管理系统</title>
  <!--[if lt IE 9]>
  <meta http-equiv="refresh" content="0;ie.html" />
  <![endif]-->
  <link href="{{loadEdition('/admin/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{loadEdition('/admin/css/font-awesome.css')}}" rel="stylesheet">
  <link href="{{loadEdition('/admin/css/animate.min.css')}}" rel="stylesheet">
  <link href="{{loadEdition('/admin/css/style.css')}}" rel="stylesheet">
  <link href="{{loadEdition('/admin/js/layui/css/layui.css')}}" rel="stylesheet">
</head>
<body class="fixed-sidebar full-height-layout gray-bg" style="overflow:hidden">
<div id="wrapper">
  <!--左侧导航开始-->
  <nav class="navbar-default navbar-static-side" role="navigation">
    <div class="nav-close"><i class="fa fa-times-circle"></i> </div>
    <div class="sidebar-collapse">
      <ul class="nav" id="side-menu">
        <li class="nav-header text-center">
          <div class="dropdown profile-element">
            <span><img alt="image" class="img-circle" src="/admin/images/profile_small.png" width="64"/></span>
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="clear">
                               <span class="block m-t-xs"><strong class="font-bold">{$adminuser}</strong></span>
                                <span class="text-muted text-xs block">{$authgroup}<b class="caret"></b></span>
                                </span>
            </a>
            <ul class="dropdown-menu animated fadeInRight m-t-xs">
              <!-- <li><a class="J_menuItem" href="form_avatar.html">修改头像</a></li>
              <li><a class="J_menuItem" href="form_avatar.html">修改密码</a></li>
              <li class="divider"></li> -->
              <li><a href="{{route('admin.logout')}}">安全退出</a></li>
            </ul>
          </div>
          <div class="logo-element">YS+</div>
        </li>
        <li> <a title="网站首页" href="/" target="_blank"> <i class="fa fa-home" ></i> <span class="nav-label">网站首页</span></a></li>
        <li>
          <a title="权限管理"> <i class="fa fa-user"></i> <span class="nav-label">权限管理</span> <span class="fa arrow"></span> </a>
          <ul class="nav nav-second-level collapse">
            <li> <a class="J_menuItem" href="{{ route('admins.index') }}" data-index="14">管理员</a> </li>
            <li> <a class="J_menuItem" href="{{ route('roles.index') }}" data-index="14">角色管理</a> </li>
            <li> <a class="J_menuItem" href="{{ route('rules.index') }}" data-index="14">权限管理</a> </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
  <!--左侧导航结束-->
  <!--右侧部分开始-->
  <div id="page-wrapper" class="gray-bg dashbard-1">
    <div class="row border-bottom">
      <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header"><a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
        </div>
        <ul class="nav navbar-top-links navbar-right">
          <li class="dropdown hidden-xs">
            <a href="/" target="_blank"><i class="fa fa-home"></i> 站点主页</a>
          </li>
        </ul>
      </nav>
    </div>
    <div class="row content-tabs">
      <button class="roll-nav roll-left J_tabLeft"><i class="fa fa-backward"></i>
      </button>
      <nav class="page-tabs J_menuTabs">
        <div class="page-tabs-content">
          <a href="javascript:;" class="active J_menuTab" data-id="index_v1.html">首页</a>
        </div>
      </nav>
      <button class="roll-nav roll-right J_tabRight"><i class="fa fa-forward"></i>
      </button>
      <div class="btn-group roll-nav roll-right">
        <button class="dropdown J_tabClose" data-toggle="dropdown">关闭操作<span class="caret"></span>

        </button>
        <ul role="menu" class="dropdown-menu dropdown-menu-right">
          <li class="J_tabShowActive"><a>定位当前选项卡</a>
          </li>
          <li class="divider"></li>
          <li class="J_tabCloseAll"><a>关闭全部选项卡</a>
          </li>
          <li class="J_tabCloseOther"><a>关闭其他选项卡</a>
          </li>
        </ul>
      </div>
      <a href="{{route('admin.logout')}}" class="roll-nav roll-right J_tabExit"><i class="fa fa fa-sign-out"></i> 退出</a>
    </div>
    <div class="row J_mainContent" id="content-main">
      <iframe class="J_iframe" name="iframe0" width="100%" height="100%" src="{{route('index.main')}}" frameborder="0" data-id="index_v1.html" seamless></iframe>
    </div>
    <div class="footer">
      <div class="pull-right">&copy; 2015-2017 <a href="http://www.168282.com/" target="_blank">源神CMS</a>
      </div>
    </div>
  </div>
  <!--右侧部分结束-->
</div>
<script src="{{loadEdition('/admin/js/jquery.js')}}"></script>
<script src="{{loadEdition('/admin/js/bootstrap.js')}}"></script>
<script src="{{loadEdition('/admin/js/metisMenu.js')}}"></script>
<script src="{{loadEdition('/admin/js/slimscroll.js')}}"></script>
<script src="{{loadEdition('/admin/js/hplus.js')}}"></script>
<script src="{{loadEdition('/admin/js/contabs.js')}}"></script>
<script src="{{loadEdition('/admin/js/pace.js')}}"></script>
<script src="{{loadEdition('/admin/js/layui/layui.js')}}"></script>
<script>
    layui.use('layer', function(){
        var layer = layui.layer;
        layer.config({
            extend: 'espresso/style.css',
            skin: 'layer-ext-espresso'
        });
    });
</script>
</body>
</html>
