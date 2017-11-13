@extends('Admin.layouts.layout')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox-title">
                <h5>添加权限</h5>
            </div>
            <div class="ibox-content">
                <a href="{{route('rules.index')}}">
                    <button class="btn btn-primary btn-sm" type="button"><i class="fa fa-plus-circle"></i> 权限管理
                    </button>
                </a>
                <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                <form class="form-horizontal m-t-md" action="{{route('rules.update',$rule->id)}}" method="POST">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">上级权限：</label>
                        <div class="col-sm-2">
                            <select name="parent_id" class="form-control">
                                <option value="0">顶级权限</option>
                                @foreach($rules as $k=>$item)
                                    <option value="{{$item['id']}}" @if($rule->parent_id == $item['id']) selected="selected"@endif >{{$item['_name']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">权限名称：</label>
                        <div class="col-sm-3">
                            <input type="text" name="name" value="{{$rule->name}}" class="form-control" required
                                   data-msg-required="请输入权限名称">
                        </div>
                    </div>
                    <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">权限路径：</label>
                        <div class="col-sm-3">
                            <input type="text" name="route" value="{{$rule->route}}" class="form-control" required
                                   data-msg-required="请输入英文名称">
                        </div>
                    </div>
                    <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">排序：</label>
                        <div class="col-sm-1">
                            <input type="text" name="sort" {{$rule->sort}} value="255" required class="form-control">
                        </div>
                    </div>
                    <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">是否隐藏：</label>
                        <div class="col-sm-2">
                            <select name="is_hidden" class="form-control">
                                <option value="0" @if($rule->is_hidden == 0)selected="selected" @endif >显示</option>
                                <option value="1" @if($rule->is_hidden == 1)selected="selected" @endif>隐藏</option>
                            </select>
                        </div>
                    </div>
                    <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">状态：</label>
                        <div class="col-sm-2">
                            <select name="status" class="form-control">
                                <option value="1" @if($rule->status == 1)selected="selected" @endif>启用</option>
                                <option value="0" @if($rule->status == 0)selected="selected" @endif>禁用</option>
                            </select>
                        </div>
                    </div>
                    <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                    <div class="form-group">
                        <div class="col-sm-12 col-sm-offset-2">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-check"></i>&nbsp;保 存
                            </button>
                            　
                            <button class="btn btn-white" type="reset"><i class="fa fa-repeat"></i> 重 置</button>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    {{method_field('PATCH')}}
                    {{csrf_field()}}
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
