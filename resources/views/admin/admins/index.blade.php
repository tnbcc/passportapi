@extends('Admin.layouts.layout')
@section('content')
    <div class="wrapper wrapper-content animated">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <a class="menuid btn btn-primary btn-sm" href="javascript:history.go(-1)">返回</a> &nbsp;
                        <a href="{{ route('admins.create') }}" link-url="javascript:void(0)"><button class="btn btn-primary btn-sm" type="button"><i class="fa fa-plus-circle"></i> 添加管理员</button></a>
                        <a class="btn btn-success btn-sm" onclick="reloadPage(window)"><i class="fa fa-refresh"></i> 刷新</a>&nbsp;
                    </div>
                    <div class="ibox-content">
                        <div class="row m-b-sm m-t-sm">
                        </div>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th style="text-align:center;width:1%">用户ID</th>
                                <th style="text-align:center;width:3%">用户名</th>
                                <th>用户权限</th>
                                <th style="text-align:center;width:3%">最后登录时间</th>
                                <th style="text-align:center;width:6%">最后登录IP</th>
                                <th style="text-align:center;width:3%">添加时间</th>
                                <th style="text-align:center;width:3%">添加IP</th>
                                <th>登录次数</th>
                                <th style="text-align:center;width:2%">状态</th>
                                <th style="text-align:center;width:2%">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($admins as $key => $item)
                                <tr class="float-e-margins">
                                    <td style="text-align:center">{{$item->id}}</td>
                                    <td style="text-align:center">{{$item->name}}</td>
                                    <td style="text-align:center">{{date('Y-m-d H:i:s',$item->create_time)}}</td>
                                    <td style="text-align:center">{{$item->create_ip}}</td>
                                    <td style="text-align:center">{{date('Y-m-d H:i:s',$item->last_login_time)}}</td>
                                    <td style="text-align:center">{{$item->last_login_ip}}</td>
                                    <td style="text-align:center">
                                        @switch($item->status)
                                            @case(1)
                                            <span class="btn mg0 btn-info btn-xs">正常</span>
                                            @break
                                            @case(2)
                                            <span class="btn mg0 btn-danger btn-xs">禁止</span>
                                            @break
                                        @endswitch
                                    </td>
                                    <td style="text-align: center">
                                        <a href="/admin/admins/{{$item->id}}/edit" class="btn mg0 btn-primary btn-xs"><i class="fa fa-paste"></i> 编辑</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{$admins->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection