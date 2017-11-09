<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="renderer" content="webkit">
<meta http-equiv="Cache-Control" content="no-siteapp" />
<title>系统管理面板-Ansel-系统</title>
<!--[if lt IE 9]>
<meta http-equiv="refresh" content="0;ie.html" />
<![endif]-->
<link href="$public/css/bootstrap.min.css" rel="stylesheet">
<link href="$public/css/font-awesome.css" rel="stylesheet">
<link href="$public/css/animate.min.css" rel="stylesheet">
<link href="$public/css/style.css" rel="stylesheet">
<link href="$public/js/layui/css/layui.css" rel="stylesheet">
</head>
<body class="fixed-sidebar full-height-layout gray-bg" style="overflow:hidden">
<div id="wrapper"> 
  <!--左侧导航开始-->
  <nav class="navbar-default navbar-static-side" role="navigation">
    <div class="nav-close"><i class="fa fa-times-circle"></i> </div>
    <div class="sidebar-collapse">
      <ul class="nav" id="side-menu">
        <li class="nav-header" style="padding-top:10px;">
          <div class="dropdown profile-element">  
           <span><img alt="{:session('userinfo.username')}" style="width:140px;height:45px;margin-top:5px;" src="$public/images/logo.png" /></span> 
           <a data-toggle="dropdown" class="dropdown-toggle" href="javascript:;"> 
            <span class="clear"> 
            	<span class="block m-t-xs"><strong class="font-bold">欢迎您：{:session('userinfo.username')}</strong></span> 
                <span class="text-muted text-xs block">{:getGroupName()}<b class="caret"></b></span> 
            </span> 
           </a>
            <ul class="dropdown-menu m-t-xs">
              <li><a onclick="cache('site')" style="text-align:center">清除全部缓存</a> </li>
              <li class="divider"></li>
              <li><a onclick="cache('template')" style="text-align:center">清除模板缓存</a> </li>
              <li class="divider"></li>
              <li><a onclick="cache('logs')" style="text-align:center">清除站点日志</a> </li>
              <li class="divider"></li>
              <li><a href="{:U('Login/logout')}" style="text-align:center">安全退出</a> </li>
            </ul>
          </div>
          <div class="logo-element">A</div>
        </li>
        <li> <a title="网站首页" href="/" target="_blank"> <i class="fa fa-home" ></i> <span class="nav-label">网站首页</span></a></li>
        <volist name="menu" id="vo">
          <if condition="$vo['sub_menu']">
            <li> <a title="{$vo.name}"> <i class="fa fa-{$vo.fonts|default="desktop"}" ></i> <span class="nav-label">{$vo.name}</span> <span class="fa arrow"></span> </a>
              <ul class="nav nav-second-level">
                <volist name="vo['sub_menu']" id="sub">
                  <php> $app=$sub['app'];$controller=$sub['controller'];$action=$sub['action'];
                    $menuid='menuid='.$sub['id'];$parameter=$menuid.'&'.$sub['parameter'] </php>
                  <li> <a class="J_menuItem"  href="{:U(''.$app.'/'.$controller.'/'.$action.'',$parameter)}">{$sub.name}</a> </li>
                </volist>
              </ul>
            </li>
            <else/>
            <php> $app=$vo['app'];$controller=$vo['controller'];$action=$vo['action'];
              $menuid='menuid='.$vo['id'];$parameter=$menuid.'&'.$vo['parameter']</php>
            <li> <a class="J_menuItem" href="{:U(''.$app.'/'.$controller.'/'.$action.'',$parameter)}"  title="{$vo.name}"><i class="fa fa-{$vo.fonts}"></i> <span class="nav-label">{$vo.name}</span></a> </li>
          </if>
        </volist>
      </ul>
    </div>
  </nav>
  <!--左侧导航结束--> 
  <!--右侧部分开始-->
  <div id="page-wrapper" class="gray-bg dashbard-1">
    <div class="row border-bottom">
      <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
        	<a class="navbar-minimalize minimalize-styl-2 btn btn-primary"><i class="fa fa-bars"></i> </a>
            <a class="minimalize-styl-2 btn btn-success" title="后台首页" href=""><i class="fa fa-home"></i> 后台首页</a>
            <a class="minimalize-styl-2 btn btn-info" title="网站首页" href="/" target="_blank"><i class="fa fa-home"></i> 网站首页</a>
            <a class="minimalize-styl-2 btn btn-danger" title="开发文档" href="http://www.kancloud.cn/hj951224/ansel" target="_blank"><i class="fa fa-file"></i> 开发文档</a>
            <a class="minimalize-styl-2 btn btn-default J_menuItem" title="表单设计" href="{:U('Index/form_builder')}" target="_blank"><i class="fa fa-edit"></i> 表单设计</a>
        </div>
        <ul class="nav navbar-top-links navbar-right">
          {:hook('Admintopmenu')}
          <li class="dropdown hidden-xs"> <a class="right-sidebar-toggle" aria-expanded="false"> <i class="fa fa-tasks"></i> 主题 </a> </li>
        </ul>
      </nav>
    </div>
    <div class="row content-tabs">
      <button class="roll-nav roll-left J_tabLeft"><i class="fa fa-backward"></i> </button>
      <nav class="page-tabs J_menuTabs">
        <div class="page-tabs-content"> <a href="javascript:;" class="active J_menuTab" data-id="index_v1.html">首页</a> </div>
      </nav>
      <button class="roll-nav roll-right J_tabRight"><i class="fa fa-forward"></i> </button>
      <div class="btn-group roll-nav roll-right">
        <button class="dropdown J_tabClose" data-toggle="dropdown">关闭操作<span class="caret"></span> </button>
        <ul role="menu" class="dropdown-menu dropdown-menu-right">
          <li class="J_tabShowActive"><a>定位当前选项卡</a> </li>
          <li class="divider"></li>
          <li class="J_tabCloseAll"><a>关闭全部选项卡</a> </li>
          <li class="J_tabCloseOther"><a>关闭其他选项卡</a> </li>
        </ul>
      </div>
      <a href="{:U('Login/logout')}" class="roll-nav roll-right J_tabExit"><i class="fa fa fa-sign-out"></i> 退出</a> </div>
    <div class="row J_mainContent" id="content-main">
      <iframe class="J_iframe" name="iframe0" width="100%" height="100%" src="{:U('Index/home')}" frameborder="0" data-id="index_v1.html" seamless></iframe>
    </div>
    <div class="footer">
      <div class="pull-left">感谢使用 <a href="http://www.95ansel.cc" target="_blank">Ansel</a> 系统</div>
      <div class="pull-right">© 2014-2016 绵阳人维网络科技有限公司版权所有</div>
    </div>
  </div>
  <!--右侧部分结束--> 
  <!--右侧边栏开始-->
  <div id="right-sidebar">
    <div class="sidebar-container">
      <ul class="nav nav-tabs navs-3">
        <li class="active"> <a data-toggle="tab" href="#tab-1"> <i class="fa fa-gear"></i> 主题 </a> </li>
      </ul>
      <div class="tab-content">
        <div id="tab-1" class="tab-pane active">
          <div class="sidebar-title">
            <h3> <i class="fa fa-comments-o"></i> 主题设置</h3>
            <small><i class="fa fa-tim"></i> 你可以从这里选择和预览主题的布局和样式，这些设置会被保存在本地，下次打开的时候会直接应用这些设置。</small> </div>
          <div class="skin-setttings">
            <div class="title">主题设置</div>
            <div class="setings-item"> <span>收起左侧菜单</span>
              <div class="switch">
                <div class="onoffswitch">
                  <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="collapsemenu">
                  <label class="onoffswitch-label" for="collapsemenu"> <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span> </label>
                </div>
              </div>
            </div>
            <div class="setings-item"> <span>固定顶部</span>
              <div class="switch">
                <div class="onoffswitch">
                  <input type="checkbox" name="fixednavbar" class="onoffswitch-checkbox" id="fixednavbar">
                  <label class="onoffswitch-label" for="fixednavbar"> <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span> </label>
                </div>
              </div>
            </div>
            <div class="setings-item"> <span> 固定宽度 </span>
              <div class="switch">
                <div class="onoffswitch">
                  <input type="checkbox" name="boxedlayout" class="onoffswitch-checkbox" id="boxedlayout">
                  <label class="onoffswitch-label" for="boxedlayout"> <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span> </label>
                </div>
              </div>
            </div>
            <div class="title">皮肤选择</div>
            <div class="setings-item default-skin nb"> <span class="skin-name "> <a href="#" class="s-skin-0"> 默认皮肤 </a> </span> </div>
            <div class="setings-item blue-skin nb"> <span class="skin-name "> <a href="#" class="s-skin-1"> 蓝色主题 </a> </span> </div>
            <div class="setings-item yellow-skin nb"> <span class="skin-name "> <a href="#" class="s-skin-3"> 黄色/紫色主题 </a> </span> </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--右侧边栏结束--> 
</div>
<script src="$public/js/jquery.js"></script> 
<script src="$public/js/bootstrap.js"></script> 
<script src="$public/js/metisMenu.js"></script> 
<script src="$public/js/slimscroll.js"></script> 
<script src="$public/js/hplus.js"></script> 
<script src="$public/js/contabs.js"></script> 
<script src="$public/js/pace.js"></script>
<script src="$public/js/layui/layui.js"></script>
<script>
layui.use('layer', function(){ 
var layer = layui.layer;
	layer.config({
	  extend: 'espresso/style.css',
	  skin: 'layer-ext-espresso'
	});
});
//更新缓存
function cache(type){
	$.ajax({  
		url : '{:U("Index/cache")}',  
		type : "post",  
		dataType : "json",  
		data:{type:type},
		success : function(res) {  
			if(res.status) {  
				layer.msg(""+res.info+"....",{icon:1,time:1000},function(){
					var location = win.location;
					location.href = location.pathname + location.search;
				});
			} else {  
				layer.alert(res.info,{title:'错误提示',icon:0});
			}  
		}  
	});
}
</script>
</body>
</html>
