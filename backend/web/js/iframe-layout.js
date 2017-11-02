$(function () {
    var body = $("body"),
        topWin = $(top.window.document),
        hrefList = {}, // 路由信息存储的变量
        hrefListNull = true, // 路由信息存储是否为空
        iframeQueryParam = 'target', // iframe 追加的参数的名
        ifraemQueryValue = 'iframe', // iframe 追加的参数的值
        iframeWrapClass = 'content-iframe', // iframe 追加的进入的区域
        iframeClass = 'iframe-layout', // 每个 iframe 上的 class
        menuTabClass = 'menu-tabs', // 顶部 tab 菜单的 class
        closeMenuTabClass = 'close-menu-tab'; // tab 菜单关闭的 class

    // 在 url query 上设置参数
    function setQueryParam($url, $name, $value) {
        var pos = $url.indexOf('?');
        if (pos < 0) {
            $url += '?';
        } else {
            $url += '&';
        }
        return $url + $name + '=' + $value;
    }

    if (self.frameElement && self.frameElement.tagName == "IFRAME") {
        // 表单提交的处理
        $('form').prepend('<input type="hidden" name="target" value="iframe">');
        // a 链接处理
        $('a').each(function () {
            // 跳过使用 show_ajax_modal 的
            if ($(this).hasClass('show_ajax_modal')) {
                return true;
            }
            $(this).attr('href', setQueryParam($(this).attr('href'), iframeQueryParam, ifraemQueryValue));
        })
    } else {
        // 设置 iframe 高度
        function setIframeHeight(iframe) {
            if (iframe) {
                var iframeWin = iframe.contentWindow || iframe.contentDocument.parentWindow;
                if (iframeWin.document.body) {
                    iframe.height = iframeWin.document.documentElement.scrollHeight || iframeWin.document.body.scrollHeight;
                }
            }
        }

        // 增加顶部menu tab
        function addSubMenuLi(title, href, needClose) {
            var li = '<li id="sub-menu-' + title + '" class="sub-menu">' +
                '<a href="' + href + '"><span>' + title + '</span></a>';
            if (needClose) {
                li += '<i class="fa fa-close ' + closeMenuTabClass + '"></i>';
            }
            li += '</li>';
            topWin.find('.' + menuTabClass).append(li);
        }

        // 高亮sub menu
        function subMenuActive(title) {
            topWin.find('.menu-tabs li.active').removeClass('active');
            topWin.find('#sub-menu-' + title).addClass('active');
        }

        // 显示 iframe
        function iframeShow(title) {
            topWin.find('.' + iframeClass).hide();
            topWin.find('#iframe-' + title).show();
        }

        // 移除一个 iframe
        function iframeRemove(title) {
            topWin.find('#iframe-' + title).remove();
        }

        body.on('click', '.' + menuTabClass + ' li a,.sidebar li a', function (e) {
            e.preventDefault();
            var href = $(this).attr('href'),
                title = $(this).find('span').text();
            if (href == '#' || href == 'javascript:' || href == 'javascript:;' || href == 'javascript:void(0);') {
                return;
            }
            $('.sidebar li').removeClass('active').each(function () {
               if($(this).find('span').text() == title){
                   $(this).addClass('active');
                   $(this).parents('li').addClass('active');
               }
            });
            if (!hrefList[title]) {
                // 路由表中不存在，则加入路由表，然后显示该链接
                hrefList[title] = href;
                var html = '<iframe id="iframe-' + title + '" class="' + iframeClass + '" src="' + setQueryParam(href, iframeQueryParam, ifraemQueryValue) + '"></iframe>';
                addSubMenuLi(title, href, true);
                if (hrefListNull) {
                    topWin.find('.' + iframeWrapClass).html(html);
                    hrefListNull = false;
                } else {
                    topWin.find('.' + iframeWrapClass).append(html);
                }
                $('#iframe-' + title).load(function (e) {
                    setIframeHeight(e.target);
                });
            }
            iframeShow(title);
            subMenuActive(title);
        });

        body.on('click', '.' + closeMenuTabClass, function () {
            var title = $(this).siblings('a').find('span').text(),
                currentLi = $(this).parent('li');
            delete hrefList[title];
            iframeRemove(title);
            if (currentLi.hasClass('active')) {
                // 是当前打开的页面
                var lastTitle = Object.keys(hrefList).pop();
                iframeShow(lastTitle);
                subMenuActive(lastTitle);
            }
            currentLi.remove();
        });
    }
});