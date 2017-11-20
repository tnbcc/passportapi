
@extends('admin.layouts.layout')

@section('title', '首页')

@section('css')
  <link href="{{loadEdition('/admin/css/pxgridsicons.min.css')}}" rel="stylesheet" />
@endsection
@section('content')
  <div class="row state-overview">
    <div class="col-lg-3 col-sm-6">
      <section class="panel">
        <div class="symbol userblue">
          <i class="icon-users"></i>
        </div>
        <div class="value">
          <a href="#"><h1 id="count1">1</h1></a>
          <p>用户总量</p>
        </div>
      </section>
    </div>
    <div class="col-lg-3 col-sm-6">
      <section class="panel">
        <div class="symbol commred">
          <i class="icon-user-add"></i>
        </div>
        <div class="value">
          <a href="#"><h1 id="count2">56</h1></a>
          <p>今日注册用户</p>
        </div>
      </section>
    </div>
    <div class="col-lg-3 col-sm-6">
      <section class="panel">
        <div class="symbol articlegreen">
          <i class="icon-check-circle"></i>
        </div>
        <div class="value">
          <a href="#"><h1 id="count3">1876</h1></a>
          <p>笑话总数</p>
        </div>
      </section>
    </div>
    <div class="col-lg-3 col-sm-6">
      <section class="panel">
        <div class="symbol rsswet">
          <i class="icon-file-word-o"></i>
        </div>
        <div class="value">
          <a href="#"><h1 id="count4">3</h1></a>
          <p>待审核笑话总数</p>
        </div>
      </section>
    </div>
  </div>
  <div class="row">
    <!-- 表单 -->
    <div class="col-lg-6">
      <section class="panel">
        <header class="panel-heading bm0">
          <span><strong>最新发布内容</strong></span>
          <span class="tools pull-right">
                                <a class="icon-chevron-down" href="javascript:;"></a>
                            </span>

        </header>
        <div class="panel-body" id="panel-bodys" style="display: block;">
          <table class="table table-hover personal-task">
            <tbody>
            <volist name="jokelist" id="v">
              <tr>
                <td>{$v.type|getjokecate}</td>
                <td><a href="{:U('/admin/joke/edit',array('id'=>$v['id']))}">{$v.title|mb_substr=0,50,'UTF-8'}</a></td>
                <td width="110">{$v.create_time|date='m-d H:i:s',###}</td>
              </tr>
            </volist>
            </tbody>
          </table>
        </div>
      </section>
    </div>
    <!-- 表单 -->

    <!-- 版权信息 -->
    <div class="col-lg-6">
      <section class="panel">
        <header class="panel-heading bm0">
          <span><strong>团队及版权信息</strong></span>
          <span class="tools pull-right">
                                <a class="icon-chevron-down" href="javascript:;"></a>
                            </span>
        </header>
        <div class="panel-body" id="panel-bodys" style="display: block;">
          <table class="table table-hover personal-task">
            <tbody>
            <tr>
              <td>
                <strong>检测更新</strong>：已是最新版
              </td>
              <td></td>
            </tr>
            <tr>
              <td><strong>程序名称</strong>：源神CMS笑话系统 </td>
              <td></td>
            </tr>
            <tr>
              <td><strong>当前版本</strong>：V4.4</td>
              <td></td>
            </tr>
            <tr>
              <td><strong>开发团队</strong>：梦龙、背着棺材跳舞 、翱翔蔚蓝 </td>
              <td></td>
            </tr>
            <tr>
              <td><strong>版权所有</strong>：<a href="http://www.168282.com" target="_bliank">安徽源神网络科技有限公司</a> </td>
              <td></td>
            </tr>
            <tr>
              <td>
                <strong>操作系统：</strong>：{{PHP_OS}}</td>
              <td></td>
            </tr>
            <tr>
              <td>
                <strong>WEB服务器</strong>：{{php_sapi_name()}}</td>
              <td></td>
            </tr>
            <tr>
              <td>
                <strong>PHP版本</strong>：{{PHP_VERSION}}</td>
              <td></td>
            </tr>
            <tr>
              <td>
                <strong>MySQL版本</strong>：{$mysql}</td>
              <td></td>
            </tr>
            <tr>
              <td>
                <strong>官方网址</strong>：http://www.168282.com</td>
              <td></td>
            </tr>
            <tr>
              <td>
                <strong>客服QQ</strong>：4008885302</td>
              <td></td>
            </tr>
            <tr>
              <td>
                <strong>服务热线</strong>：400-888-5302</td>
              <td></td>
            </tr>
            </tbody>
          </table>
        </div>
      </section>
    </div>
    <!-- 版权信息 -->
  </div>
  <div class="row">
    <div class="col-sm-12">
      <div class="ibox-title">
        <h5>系统更新日志</h5>
      </div>
      <div class="ibox-content timeline">
        <div class="timeline-item">
          <div class="row">
            <div class="col-xs-3 date">
              <i class="fa fa-file-text"></i>
              <small class="text-navy">2017年3月30日更新</small>
            </div>
            <div class="col-xs-7 content">
              <p class="m-b-xs"><strong>源神CMS笑话系统V4.4</strong>
              </p>
              <p>
                1、修复后台开启水印时缺少字体 √<br>
                1、修复视频上传到七牛云后没有后缀导致手机端无法播放 √<br>
                2、填加了火车头采集后台生成GIF缩略图 √<br>
                3、填加了定时任务审核功能 √<br>
                4、修复了后台一些样式问题 √<br>
                5、修复了安装软件的流程！√<br>
                6、PC+WAP端发布页一处BUG修复√<br>
              </p>
            </div>
          </div>
        </div>

        <div class="timeline-item">
          <div class="row">
            <div class="col-xs-3 date">
              <i class="fa fa-file-text"></i>
              <small class="text-navy">2015年10月份</small>
            </div>
            <div class="col-xs-7 content">
              <p class="m-b-xs"><strong>虾囧CMSV1.0诞生</strong>
              </p>
              <p>
                有段子、趣图、GIF动图、视频、笑点、神回复、积分商城等栏目<br>
                网址：http://www.xiajiong.com
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@stop
