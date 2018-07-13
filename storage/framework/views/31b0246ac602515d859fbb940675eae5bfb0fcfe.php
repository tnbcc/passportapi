<html>
<head>

    <link rel="stylesheet" href="http://cdn.amazeui.org/amazeui/2.7.2/css/amazeui.css">

    <script src="<?php echo e(loadEdition('/js/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(loadEdition('/admin/js/bootstrap.min.js')); ?>"></script>
    <script src="http://cdn.amazeui.org/amazeui/2.7.2/js/amazeui.js"></script>
    <script src="https://cdn.bootcss.com/jquery.fileDownload/1.4.2/jquery.fileDownload.js"></script>

</head>
<body>
<a href="javascript:void(0);" onclick="fileDown();">导出</a>

<div class="am-modal am-modal-confirm" tabindex="-1" id="my-confirm">
    <div class="am-modal-dialog">
        <div class="am-modal-bd tk_title">
            内容
        </div>
        <div class="am-modal-footer">
            <span class="am-modal-btn" data-am-modal-cancel>取消</span>
            <span class="am-modal-btn" data-am-modal-confirm>下载账单</span>
        </div>
    </div>
</div>



<div class="am-modal am-modal-alert" tabindex="-1" id="my-alert">
    <div class="am-modal-dialog">
        <div class="am-modal-hd">Amaze UI</div>
        <div class="am-modal-bd">
            Hello world！
        </div>
        <div class="am-modal-footer">
            <span class="am-modal-btn">确定</span>
        </div>
    </div>
</div>



<div class="am-modal am-modal-loading am-modal-no-btn" tabindex="-1" id="my-modal-loading">
    <div class="am-modal-dialog">
        <div class="am-modal-hd">正在载入...</div>
        <div class="am-modal-bd">
            <span class="am-icon-spinner am-icon-spin"></span>
        </div>
    </div>
</div>


<script>
    // 询问框
    function fileDown() {
        var content = '确定要导出表格吗？'; // 提示内容
        $('.tk_title').text(content);
        $('#my-confirm').modal({ // 询问框id名称
            relatedTarget: this,
            onConfirm: function(options) {
                downloading();
            },
            onCancel: function() {
                //点击了取消
            }
        });
    }

    // 弹出框
    var modal = $('#my-alert');
    function my_alert(title, content, open) {
        modal.find('.am-modal-hd').html(title);
        modal.find('.am-modal-bd').html(content);
        if (open) {
            modal.modal();
        } else {
            modal.modal('close');
        }
    }

    // 加载框
    var modal_loading = $('#my-modal-loading');
    function my_loading(title, open) {
        modal_loading.find('.am-modal-hd').html(title);
        if (open) {
            modal_loading.modal();
        } else {
            modal_loading.modal('close');
        }
    }

    // 下载事件
    function downloading() {
        my_loading( '加载中，请稍后...', true);
        $.ajax({
            type: 'post',
            dataType: "json",
            data: {
                _token: "<?php echo e(csrf_token()); ?>",
                types: 2, //重要，体现在后端
                // 其他参数
            },
            url: "<?php echo e(route('excel.exports')); ?>",
            // 其他参数
            success: function (result, textStatus) {
                if (result.status == 'success') {
                    my_loading("加载中，请稍后...", false);
                    $.fileDownload("<?php echo e(route('excel.exports')); ?>", {
                        //data: date,
                        prepareCallback: function (url) {
                            my_loading("正在下载，请稍后...", true);
                        },
                        successCallback: function (url) {
                            my_loading("正在下载，请稍后...", false);
                            my_alert("SUCCESS", "导出完成！", true);
                        },
                        failCallback: function (html, url) {
                            my_loading("正在下载，请稍后...", false);
                            my_alert("ERROR", "导出失败，未知的异常！", true);
                        }
                    });
                } else {
                    my_loading("正在下载，请稍后...", false);
                    my_alert(result.msg, true);
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                my_alert("ERROR", textStatus, true);
            }
        });
    }
</script>
</body>
</html>