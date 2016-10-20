/**
 * Created by Administrator on 2015.12.23.
 */
/*
 * 注意：
 * 1. 所有的JS接口只能在公众号绑定的域名下调用，公众号开发者需要先登录微信公众平台进入“公众号设置”的“功能设置”里填写“JS接口安全域名”。
 * 2. 如果发现在 Android 不能分享自定义内容，请到官网下载最新的包覆盖安装，Android 自定义分享接口需升级至 6.0.2.58 版本及以上。
 * 3. 完整 JS-SDK 文档地址：http://mp.weixin.qq.com/wiki/7/aaa137b55fb2e0456bf8dd9148dd613f.html
 *
 * 如有问题请通过以下渠道反馈：
 * 邮箱地址：weixin-open@qq.com
 * 邮件主题：【微信JS-SDK反馈】具体问题
 * 邮件内容说明：用简明的语言描述问题所在，并交代清楚遇到该问题的场景，可附上截屏图片，微信团队会尽快处理你的反馈。
 */
var wxopenurl = "your-website";
function WX(appid, callback) {

    appid = appid;
    this.init = function () {
        var data = {
            appid: appid,
            url: window.location.href
        };
        $.ajax({
            url: wxopenurl + 'getSignPackage.php',
            type: 'get',
            data: data,
            //dataType: 'json',
            dataType: 'jsonp',
            jsonp: "jsoncallback",
            success: function (data) {
                var options = {
                    //debug: true,
                    appId: data.appId,
                    timestamp: data.timestamp,
                    nonceStr: data.nonceStr,
                    signature: data.signature,
                    jsApiList: [
                        'checkJsApi',
                        'onMenuShareTimeline',
                        'onMenuShareAppMessage',
                        'onMenuShareQQ',
                        'onMenuShareWeibo',
                        'onMenuShareQZone',
                        'hideMenuItems',
                        'showMenuItems',
                        'hideAllNonBaseMenuItem',
                        'showAllNonBaseMenuItem',
                        'translateVoice',
                        'startRecord',
                        'stopRecord',
                        'onVoiceRecordEnd',
                        'playVoice',
                        'onVoicePlayEnd',
                        'pauseVoice',
                        'stopVoice',
                        'uploadVoice',
                        'downloadVoice',
                        'chooseImage',
                        'previewImage',
                        'uploadImage',
                        'downloadImage',
                        'getNetworkType',
                        'openLocation',
                        'getLocation',
                        'hideOptionMenu',
                        'showOptionMenu',
                        'closeWindow',
                        'scanQRCode',
                        'chooseWXPay',
                        'openProductSpecificView',
                        'addCard',
                        'chooseCard',
                        'openCard',
                        // 所有要调用的 API 都要加到这个列表中
                    ]
                };
                wx.config(options);
                wx.ready(callback);
            },
            error: function (data) {
                //alert(data);
            },
        });

    }

    wx.error(function (res) {
        //alert(res.errMsg);
    });

    /**
     * 获取用户信息
     * @param callbackurl 回调url
     * @param scope 获取用户信息的方式
     */
    this.getUserData = function (callbackurl, scope) {
        if (scope == undefined || scope == null) {
            scope = "snsapi_userinfo";
        }
        if (callbackurl == undefined || callbackurl == null) {
            alert("缺少回调url！");
        }
        window.location.href = wxopenurl + "userinfoservice.php?appid="
            + appid + "&scope=" + scope + "&client_callback="
            + callbackurl;
    }
    // 基础接口
    /**
     * 判断当前客户端是否支持指定JS接口
     * @param options
     */
    this.checkJsApi = function (options) {
        wx.checkJsApi(options);
    }

    // 分享接口
    /**
     * 获取“分享到朋友圈”按钮点击状态及自定义分享内容接口
     * @param options
     */
    this.onMenuShareTimeline = function (options) {
        wx.onMenuShareTimeline(options);
    }

    /**
     * 获取“分享给朋友”按钮点击状态及自定义分享内容接口
     * @param options
     */
    this.onMenuShareAppMessage = function (options) {
        wx.onMenuShareAppMessage(options);
    }

    /**
     * 获取“分享到QQ”按钮点击状态及自定义分享内容接口
     * @param options
     */
    this.onMenuShareQQ = function (options) {
        wx.onMenuShareQQ(options);
    }

    /**
     * 获取“分享到腾讯微博”按钮点击状态及自定义分享内容接口
     * @param options
     */
    this.onMenuShareWeibo = function (options) {
        wx.onMenuShareWeibo(options);
    }

    /**
     * 获取“分享到QQ空间”按钮点击状态及自定义分享内容接口
     * @param options
     */
    this.onMenuShareQZone = function (options) {
        wx.onMenuShareQZone(options);
    }

    // 界面操作接口
    /**
     * 隐藏右上角菜单接口
     * @param options
     */
    this.hideOptionMenu = function (options) {
        wx.hideOptionMenu(options);
    }
    /**
     * 显示右上角菜单接口
     * @param options
     */
    this.showOptionMenu = function (options) {
        wx.showOptionMenu(options);
    }
    /**
     * 关闭当前网页窗口接口
     * @param options
     */
    this.closeWindow = function (options) {
        wx.closeWindow(options);
    }

    /**
     * 批量隐藏功能按钮接口
     * @param options
     */
    this.hideMenuItems = function (options) {
        wx.hideMenuItems(options);
    }
    /**
     * 批量显示功能按钮接口
     * @param options
     */
    this.showMenuItems = function (options) {
        wx.showMenuItems(options);
    }

    /**
     * 隐藏所有非基础按钮接口
     * @param options
     */
    this.hideAllNonBaseMenuItem = function (options) {
        wx.hideAllNonBaseMenuItem(options);
    }

    /**
     * 显示所有非基础按钮接口
     * @param options
     */
    this.showAllNonBaseMenuItem = function (options) {
        wx.showAllNonBaseMenuItem(options);
    }

    //音频接口
    /**
     * 识别音频并返回识别结果接口
     * @param options
     */
    this.translateVoice = function (options) {
        wx.translateVoice(options);
    }
    /**
     * 开始录音接口
     * @param options
     */
    this.startRecord = function (options) {
        wx.startRecord(options);
    }
    /**
     * 停止录音接口
     * @param options
     */
    this.stopRecord = function (options) {
        wx.stopRecord(options);
    }
    /**
     * 当录音结束
     * @param options
     */
    this.onVoiceRecordEnd = function (options) {
        wx.onVoiceRecordEnd(options);
    }
    /**
     * 播放语音接口
     * @param options
     */
    this.playVoice = function (options) {
        wx.playVoice(options);
    }
    /**
     * 当语音播放结束
     * @param options
     */
    this.onVoicePlayEnd = function (options) {
        wx.onVoicePlayEnd(options);
    }
    /**
     * 暂停语音播放
     * @param options
     */
    this.pauseVoice = function (options) {
        wx.pauseVoice(options);
    }
    /**
     * 停止播放接口
     * @param options
     */
    this.stopVoice = function (options) {
        wx.stopVoice(options);
    }
    /**
     * 上传语音接口
     * @param options
     */
    this.uploadVoice = function (options) {
        wx.uploadVoice(options);
    }

    /**
     * 下载语音接口
     * @param options
     */
    this.downloadVoice = function (options) {
        wx.downloadVoice(options);
    }

    // 图像接口
    /**
     * 拍照或从手机相册中选图接口
     * @param options
     */
    this.chooseImage = function (options) {
        wx.chooseImage(options);
    }
    /**
     * 预览图片接口
     * @param options
     */
    this.previewImage = function (options) {
        wx.previewImage(options);
    }
    /**
     * 上传图片接口
     * @param options
     */
    this.uploadImage = function (options) {
        wx.uploadImage(options);
    }
    /**
     * 下载图片接口
     * @param options
     */
    this.downloadImage = function (options) {
        wx.downloadImage(options);
    }
    //设备信息接口
    /**
     * 获取网络状态接口
     * @param options
     */
    this.getNetworkType = function (options) {
        wx.getNetworkType(options);
    }
    //地理位置接口
    /**
     * 使用微信内置地图查看位置接口
     * @param options
     */
    this.openLocation = function (options) {
        wx.openLocation(options);
    }
    /**
     * 获取地理位置接口
     * @param options
     */
    this.getLocation = function (options) {
        wx.getLocation(options);
    }

    /**
     * 微信扫一扫
     * @param options
     */
    this.scanQRCode = function (options) {
        wx.scanQRCode(options);
    }
    //微信支付接口
    /**
     * 发起一个微信支付请求
     * @param options
     */
    this.chooseWXPay = function (options) {
        wx.chooseWXPay(options);
    }
    //微信小店接口
    /**
     * 跳转微信商品页接口
     * @param options
     */
    this.openProductSpecificView = function (options) {
        wx.openProductSpecificView(options);
    }
    //微信卡券接口
    /**
     * 批量添加卡券接口
     * @param options
     */
    this.addCard = function (options) {
        wx.addCard(options);
    }
    /**
     * 调起适用于门店的卡券列表并获取用户选择列表
     * @param options
     */
    this.chooseCard = function (options) {
        wx.chooseCard(options);
    }
    /**
     * 查看微信卡包中的卡券接口
     * @param options
     */
    this.openCardthis = function (options) {
        wx.openCardthis(options);
    }
}