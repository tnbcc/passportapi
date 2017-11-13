@extends('Admin.layouts.layout')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox-title">
                <h5>管理员管理</h5>
            </div>
            <div class="ibox-content">
                <a class="menuid btn btn-primary btn-sm" href="javascript:history.go(-1)">返回</a>
                <a href="{{route('admins.create')}}" link-url="javascript:void(0)"><button class="btn btn-primary btn-sm" type="button"><i class="fa fa-plus-circle"></i> 添加管理员</button></a>
                <a class="btn btn-success btn-sm" onclick="reloadPage(window)"><i class="fa fa-refresh"></i> 刷新</a>
                <form method="post" action="{{route('admins.index')}}" name="form">
                    <table class="table table-striped table-bordered table-hover m-t-md">
                        <thead>
                        <tr>
                            <th style="text-align:center;width:1%"> <input type="checkbox" class="i-checks" id="chkall"></th>
                            <th class="text-center" width="100">ID</th>
                            <th>用户名</th>
                            <th>用户权限</th>
                            <th class="text-center">最后登录IP</th>
                            <th class="text-center" width="150">最后登录时间</th>
                            <th class="text-center" width="150">注册时间</th>
                            <th class="text-center" width="150">注册IP</th>
                            <th class="text-center" width="80">登录次数</th>
                            <th class="text-center" width="80">状态</th>
                            <th class="text-center" width="200">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($admins as $k => $item)
                            <tr>
                                <td style="text-align:center;width:1%">
                                    <input type="checkbox" id="ck_id" class="i-checks" name="ids[]"  value="{{$item->id}}">
                                </td>
                                <td class="text-center">{{$item->id}}</td>
                                <td>{{$item->name}}</td>
                                <td>
                                    @foreach($item->roles as $role)
                                        {{$role->name}}
                                    @endforeach
                                </td>
                                <td class="text-center">{{$item->last_login_ip}}</td>
                                <td class="text-center">{{$item->updated_at}}</td>
                                <td class="text-center">{{$item->created_at}}</td>
                                <td class="text-center">{{$item->create_ip}}</td>
                                <td class="text-center">{{$item->login_count}}</td>
                                <td class="text-center">
                                    @if($item->status == 1)
                                        <span class="text-navy">正常</span>
                                    @elseif($item->status == 2)
                                        <span class="text-danger">锁定</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="{{route('admins.edit',$item->id)}}">
                                            <button class="btn btn-primary btn-xs" type="button"><i class="fa fa-paste"></i> 修改</button>
                                        </a>
                                        @if($item->status == 2)
                                                <a href="{{route('admins.status',['status'=>1,'id'=>$item->id])}}"><button class="btn btn-info btn-xs" type="button"><i class="fa fa-warning"></i> 恢复</button></a>
                                        @else
                                                <a href="{{route('admins.status',['status'=>2,'id'=>$item->id])}}"><button class="btn btn-warning btn-xs" type="button"><i class="fa fa-warning"></i> 禁用</button></a>
                                        @endif
                                        <form class="form-common" action="{{route('admins.destroy',$item->id)}}" method="post">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-trash-o"></i> 删除</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$admins->links()}}
                </form>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
@endsection