$(function () {
    var useragent = navigator.userAgent;
    if (useragent.match(/MicroMessenger/i) != 'MicroMessenger') {
        $('body').html("<div style='width:100%; height:100%; background-color: #efefef;'><br /><br /><br />" +
            "<p style='font-size: 30px; color:green; text-align: center;width:100%; height:100%;'>" +
            "已禁止本次访问：您必须使用微信内置浏览器访问本页面！</p></div>");

    }

});