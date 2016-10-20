var wxopen = new WX("wxc7e7261cb4370370", init);
wxopen.init();
function init() {
    wxopen.hideOptionMenu();
}


//function onBridgeReady() {
//    WeixinJSBridge.call('hideOptionMenu');
//}
//
//if (typeof WeixinJSBridge == "undefined") {
//    if (document.addEventListener) {
//        document.addEventListener('WeixinJSBridgeReady', onBridgeReady, false);
//    } else if (document.attachEvent) {
//        document.attachEvent('WeixinJSBridgeReady', onBridgeReady);
//        document.attachEvent('onWeixinJSBridgeReady', onBridgeReady);
//    }
//} else {
//    onBridgeReady();
//}