@extends('Admin.layouts.layout')
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox-title">
                    <h5>添加管理员</h5>
                </div>
                <div class="ibox-content">
                    <a class="menuid btn btn-primary btn-sm" href="javascript:history.go(-1)">返回</a>
                    <a href="{{route('admins.index')}}"><button class="btn btn-primary btn-sm" type="button"><i class="fa fa-plus-circle"></i> 管理员管理</button></a>
                    <a class="btn btn-success btn-sm" onclick="reloadPage(window)"><i class="fa fa-refresh"></i> 刷新</a>
                    <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                    <form class="form-horizontal m-t-md" action="{{ route('admins.update',$admin->id) }}" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        {{method_field('PATCH')}}
                        <div class="form-group">
                            <label class="col-sm-2 control-label">用户名：</label>
                            <div class="input-group col-sm-2">
                                <input type="text" class="form-control" name="name" value="{{$admin->name}}" required data-msg-required="请输入用户名">
                            </div>
                        </div>
                        <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">密码：</label>
                            <div class="input-group col-sm-2">
                                <input type="password" class="form-control" name="password" ps>
                            </div>
                        </div>
                        <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">头像：</label>
                            <div class="input-group col-sm-2">
                                <input type="file" class="form-control" name="avatr">
                                <span class="view picview ">
                                   <img id="thumbnail-avatar" class="thumbnail img-responsive" src="{{$admin->avatr}}" width="100" height="100">
                                </span>
                            </div>
                        </div>
                        <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">所属角色：</label>
                            <div class="input-group col-sm-2">
                                <select class="form-control" name="role_id">
                                    @foreach($roles as $k=>$item)
                                        @foreach($admin->roles as $key=>$role)
                                            <option value="{{$item->id}}" @if($item->id == $role->id) selected="selected" @endif>{{$item->name}}</option>
                                        @endforeach
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">状态：</label>
                            <div class="input-group col-sm-1">
                                <select class="form-control" name="status">
                                    <option value="1" @if($admin->status == 1) selected="selected" @endif>正常</option>
                                    <option value="2" @if($admin->status == 2) selected="selected" @endif>锁定</option>
                                </select>
                            </div>
                        </div>
                        <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                        <div class="form-group">
                            <div class="col-sm-12 col-sm-offset-2">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-check"></i>&nbsp;保 存</button>　<button class="btn btn-white" type="reset"><i class="fa fa-repeat"></i> 重 置</button>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection