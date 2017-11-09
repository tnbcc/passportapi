@extends('Admin.layout')
@section('content')
<div class="wrapper wrapper-content animated">
  <div class="row">
    <div class="col-sm-12">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
            <a class="menuid btn btn-primary btn-sm" href="javascript:history.go(-1)">返回</a> &nbsp;&nbsp;&nbsp;
            <a class="btn btn-success btn-sm" onclick="reloadPage(window)"><i class="fa fa-refresh"></i> 刷新</a>
        </div>
        <div class="ibox-content">
            <form class="form-horizontal m-t" action="{{ route('admins.update', $admin->id) }}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{method_field('PATCH')}}
            <div class="form-group">
              <label class="col-sm-2 control-label">名称：</label>
              <div class="col-sm-2">
                <input type="text" name="name" step="1" value="{{$admin->name}}" class="form-control">
                @if ($errors->has('name'))
                  <span class="help-block m-b-none"><i class="fa fa-info-circle"></i>{{$errors->first('name')}}</span>
                @endif
              </div>
            </div>
            <div class="form-group " id="aetherupload-wrapper" >
              <label class="col-sm-2 control-label">头像:</label>
              <div class="col-sm-3">
                <input type="file" id="file"  onchange="aetherupload(this,'avatar').success(someCallback).upload()"/>
                <div class="progress " style="height: 6px;margin-bottom: 2px;margin-top: 10px;width: 200px;">
                  <div id="progressbar" style="background:blue;height:6px;width:0;"></div>
                </div>
                <span style="font-size:12px;color:#aaa;" id="output">等待上传</span>
                <input type="hidden" name="avatar" id="savedpath" value="{{$admin->avatar}}">
                <img id="thumbnail-avatar" class="thumbnail img-responsive" src="{{admin_avatar_path($admin->avatar)}}" width="200" height="200">
                @if ($errors->has('avatar'))
                  <span class="help-block m-b-none"><i class="fa fa-info-circle"></i>{{ $errors->first('avatar') }}</span>
                @endif
              </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">状态：</label>
                <div class="col-sm-10">
                    <div class="radio radio-info radio-inline">
                        <input type="radio" id="status1" value="1" name="status" @if($admin->status == 1) checked="checked" @endif>
                        <label for="status1">正常</label>
                    </div>
                    <div class="radio radio-inline">
                        <input type="radio" id="status2" value="2" name="status" @if($admin->status == 2) checked="checked" @endif>
                        <label for="status2">禁用</label>
                    </div>
                </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
              <div class="col-sm-3 col-sm-offset-2">
                <button class="btn btn-primary" type="submit">提交</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="{{ URL::asset('js/spark-md5.min.js') }}"></script><!--需要引入spark-md5.min.js-->
<script src="{{ URL::asset('js/aetherupload.js') }}"></script><!--需要引入aetherupload.js-->
<script>
    // success(callback)中声名的回调方法需在此定义，参数callback可为任意名称，此方法将会在上传完成后被调用
    // 可使用this对象获得fileName,fileSize,uploadBaseName,uploadExt,subDir,group,savedPath等属性的值
    someCallback = function(){
        console.log(this);
        var avatar_path = "/uploads/"+this.savedPath;
        $('#thumbnail-avatar').attr('src',avatar_path);
//        $('#result').append(
//
//            '<p>原文件名：<span >'+this.fileName+'</span> | 原文件大小：<span >'+parseFloat(this.fileSize / (1000 * 1000)).toFixed(2) + 'MB'+'</span> | 储存文件名：<span >'+this.savedPath.substr(this.savedPath.lastIndexOf('/') + 1)+'</span></p>'
//        );
    }
</script>
@endsection