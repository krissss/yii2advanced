$(function () {
    var body = $("body");
    var csrfToken = $('meta[name="csrf-token"]').attr("content");

    /**
     * 自定义ajax方法
     * @param $url  请求地址
     * @param $data json数据
     * @param $successCallBack  成功后回调方法
     * @param $timeoutInfo  超时信息
     * @private
     */
    function _ajax($url, $data, $successCallBack, $timeoutInfo) {
        $.ajax({
            type: 'POST',
            url: $url,
            data: $data,
            success: $successCallBack,
            timeout: 8000,
            complete: function (XMLHttpRequest, status) {
                if (status == 'timeout') {
                    if (typeof($timeoutInfo) !== "undefined" && $timeoutInfo.length > 0) {
                        alert($timeoutInfo);
                    } else {
                        alert("请求超时，检查网络状况");
                    }
                }
            }
        });
    }

    /**
     * 批量操作
     * php需要配置
     * class 包含 simple_check_operate
     * data-url 为需要操作的地址
     * 自写对应的url地址的批量操作
     * 确保最后返回跳转地址
     * @param $class
     */
    function simpleCheckOperate($class) {
        body.on('click', '.' + $class, function () {
            var keys = $('#grid').yiiGridView('getSelectedRows');
            var url = $(this).data('url');
            if (keys.length > 0) {
                $.post(url, {_csrf: csrfToken, keys: keys}, function (data) {
                    window.location.href = data;
                });
            } else {
                alert("您还没有选择任何一项");
            }
        });
    }

    simpleCheckOperate('simple_check_operate');

    /**
     * 批量操作，需要确认
     * php需要配置
     * class 包含 check_operate_need_confirm
     * data-url 为需要操作的地址
     * data-confirm-msg 为确认的问题
     * 自写对应的url地址的批量操作
     * 确保最后返回跳转地址
     * @param $class
     */
    function checkOperateNeedConfirm($class) {
        body.on('click', '.' + $class, function () {
            var keys = $('#grid').yiiGridView('getSelectedRows');
            if (keys.length <= 0) {
                alert("您还没有选择任何一项");
                return false;
            }
            var confirmMsg = $(this).data('confirm-msg');
            if (confirm(confirmMsg)) {
                var url = $(this).data('url');
                $.post(url, {_csrf: csrfToken, keys: keys}, function (data) {
                    window.location.href = data;
                });
            }
        });
    }

    checkOperateNeedConfirm('check_operate_need_confirm');

    /**
     * 批量操作，需要确认和弹窗输入
     * php需要配置
     * class 包含 check_operate_need_confirm_and_modal
     * data-url 为需要操作的地址
     * data-confirm-msg 为确认的问题
     * 自写对应的url地址的批量操作
     * @param $class
     */
    function checkOperateNeedConfirmAndModal($class) {
        body.on('click', '.' + $class, function () {
            var confirmMsg = $(this).data('confirm-msg');
            if (confirm(confirmMsg)) {
                var keys = $('#grid').yiiGridView('getSelectedRows');
                if (keys.length <= 0) {
                    alert("您还没有选择任何一项");
                    return false;
                }
                var url = $(this).data('url');
                _ajax(url, {_csrf: csrfToken, keys: keys}, function (data) {
                    $(".ajax_modal").remove();
                    body.append(data);
                    /** $(".ajax_modal") 此处已经更新过 */
                    $(".ajax_modal").last().modal('show');
                });
            }
        });
    }

    checkOperateNeedConfirmAndModal('check_operate_need_confirm_and_modal');

    /**
     * ajax显示modal
     * php需要配置
     * a标签带href
     * class 包含 show_ajax_modal
     * 自写renderAjax modal
     * @param $class
     */
    function simpleAjaxModal($class) {
        body.on('click', '.' + $class, function (event) {
            event.preventDefault();
            var $url = $(this).attr('href');
            _ajax($url, {}, function (data) {
                $(".ajax_modal").remove();
                body.append(data);
                /** $(".ajax_modal") 此处已经更新过 */
                $(".ajax_modal").last().modal('show');
            });
        });
    }

    simpleAjaxModal('show_ajax_modal');
});