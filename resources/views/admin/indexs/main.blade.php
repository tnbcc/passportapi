@extends('admin.layouts/layout')
@section('content')
@section('css')
<link rel="stylesheet" href="{{loadEdition('/admin/css/welcome.css')}}"/>
<link rel="stylesheet" href="{{loadEdition('/admin/css/font-awesome.min.css')}}"/>
@endsection
<div class="wrapper wrapper-content animated fadeInRight">
  <div class="page">
    <div class="row card-box">
      <div class="col-lg-3 col-sm-3">
        <div class="panel purple">
          <div class="symbol">
            <i class="fa fa-jpy"></i>
          </div>
          <div class="value">
            <p class="num h40" id="today_gains">0.00</p>
            <p class="text">今日销售总额</p>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-sm-3">
        <div class="panel yellow">
          <div class="symbol">
            <i class="fa fa-bar-chart"></i>
          </div>
          <div class="value">
            <p class="num" id="today_orders">0</p>
            <p class="text">今日订单量</p>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-sm-3">
        <div class="panel green">
          <div class="symbol">
            <i class="fa fa-bank"></i>
          </div>
          <div class="value">
            <p class="num" id="today_shops">0</p>
            <p class="text">总销量</p>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-sm-3">
        <div class="panel red">
          <div class="symbol">
            <i class="fa fa-users"></i>
          </div>
          <div class="value">
            <p class="num" id="today_users">0.00</p>
            <p class="text">总收入</p>
          </div>
        </div>
      </div>
    </div>
    <!--订单小统计-->
    <div class="row mini-stat">
      <div class="col-lg-2 col-sm-2">
        <div class="panel">
                    <span class="mini-stat-icon orange">
            <i class="fa fa-money"></i>
          </span>
          <div class="mini-stat-info">
            <span class="num" id="unpayed">0</span>
            <span class="text">待付款订单数</span>
          </div>
        </div>
      </div>
      <div class="col-lg-2 col-sm-2">
        <div class="panel">
                    <span class="mini-stat-icon tar">
            <i class="fa fa-cubes"></i>
          </span>
          <div class="mini-stat-info">
            <span class="num" id="unshipped">0</span>
            <span class="text">待发货订单数</span>
          </div>
        </div>
      </div>
      <div class="col-lg-2 col-sm-2">
        <div class="panel">
                    <span class="mini-stat-icon brown">
            <i class="fa fa-truck"></i>
          </span>
          <div class="mini-stat-info">
            <span class="num" id="shipped">0</span>
            <span class="text">已发货订单数</span>
          </div>
        </div>
      </div>
      <div class="col-lg-2 col-sm-2">
        <div class="panel">
                    <span class="mini-stat-icon pink">
            <i class="fa fa-mail-reply-all"></i>
          </span>
          <div class="mini-stat-info">
            <span class="num" id="backing">0</span>
            <span class="text">失效订单数</span>
          </div>
        </div>
      </div>
      <div class="col-lg-2 col-sm-2">
        <div class="panel">
                    <span class="mini-stat-icon green">
            <i class="fa fa-pencil"></i>
          </span>
          <div class="mini-stat-info">
            <span class="num" id="unevaluate">0</span>
            <span class="text">已取消订单数</span>
          </div>
        </div>
      </div>
      <div class="col-lg-2 col-sm-2">
        <div class="panel">
                    <span class="mini-stat-icon blue">
            <i class="fa fa-check-square-o"></i>
          </span>
          <div class="mini-stat-info">
            <span class="num" id="finished">0</span>
            <span class="text">已完成订单数</span>
          </div>
        </div>
      </div>
    </div>
    <!--系统信息-->
    <div class="row">
      <div class="col-lg-12 col-sm-12">
        <div class="panel">
          <div class="panel-header">
            <h3>系统信息</h3>
          </div>
          <div class="panel-body">
            <div class="system-infor">
              <ul>
                <li>
                  <span class="dt">服务器操作系统：</span>
                  <span class="dd">Linux</span>
                </li>
                <li>
                  <span class="dt">Web服务器：</span>
                  <span class="dd">Apache/2.4.3 (Unix) OpenSSL/1.0.1e-fips PHP/5.5.19</span>
                </li>
                <li>
                  <span class="dt">PHP版本：</span>
                  <span class="dd">5.5.19</span>
                </li>
                <li>
                  <span class="dt">MySQL版本：</span>
                  <span class="dd">5.6.16-log</span>
                </li>
                <li>
                  <span class="dt">GD版本：</span>
                  <span class="dd">bundled (2.1.0 compatible)</span>
                </li>
                <li>
                  <span class="dt">时区设置：</span>
                  <span class="dd">(GMT +08:00) Beijing, Hong Kong, Perth, Singapore, Taipei</span>
                </li>
                <li>
                  <span class="dt">文件上传的最大大小：</span>
                  <span class="dd">2048 KB</span>
                </li>
                <li>
                  <span class="dt">编码：</span>
                  <span class="dd">utf-8</span>
                </li>
                <li>
                  <span class="dt">安装日期：</span>
                  <span class="dd"></span>
                </li>
                <li>
                  <span class="dt">安装版本：</span>
                  <span class="dd">
                      2.5&nbsp;&nbsp;
                      <span id="update"></span>
                                    </span>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
