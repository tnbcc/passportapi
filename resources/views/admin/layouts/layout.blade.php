<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Styles -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{loadEdition('/admin/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{loadEdition('/admin/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{loadEdition('/admin/css/checkbox.css')}}" rel="stylesheet">
    <link href="{{loadEdition('/admin/css/icheck.css')}}" rel="stylesheet">
    <link href="{{loadEdition('/admin/css/animate.min.css')}}" rel="stylesheet">
    <link href="{{loadEdition('/admin/css/style.css')}}" rel="stylesheet">
    <link href="{{loadEdition('/admin/js/layui/css/layui.css')}}" rel="stylesheet">
    <link href="{{loadEdition('/admin/js/datepicker/datepicker.css')}}" rel="stylesheet">
    @yield('css')
    <script src="{{loadEdition('/admin/js/jquery.js')}}"></script>
    <script src="{{loadEdition('/admin/js/bootstrap.js')}}"></script>
    <script src="{{loadEdition('/admin/js/layui/layui.js')}}"></script>
    @yield('js')
    <script>
        layui.use('layer', function(){
            var layer = layui.layer;
            layer.config({
            });
        });

        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body class="gray-bg">
@yield('content')
<script src="{{loadEdition('/admin/js/icheck.js')}}"></script>
<script src="{{loadEdition('/admin/js/validate/validate.js')}}"></script>
<script src="{{loadEdition('/admin/js/validate/messages.js')}}"></script>
<script src="{{loadEdition('/admin/js/common.js')}}"></script>
<script src="{{loadEdition('/admin/js/datepicker/datepicker.js')}}"></script>
<script>
    $(document).ready(function(){
        $(".i-checks").iCheck({
            checkboxClass:"icheckbox_square-green",
            radioClass:"iradio_square-green",
        })
        $('#chkall').on('ifChecked', function(event){
            $('input#ck_id').iCheck('check');
        });
        $('#chkall').on('ifUnchecked', function(event){
            $('input#ck_id').iCheck('uncheck');
        });
    });
</script>
@yield('footer-js')
</body>
</html>