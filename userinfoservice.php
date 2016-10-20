<?php
/**
 * 测试获取用户信息接口
 * User: liushuai 849351660@qq.com
 * Date: 2015.12.24
 * Time: 15:42
 */
include_once(dirname(__FILE__) . '/config.php');
include_once(dirname(__FILE__) . '/models/WXUserInfo.php');
include_once(dirname(__FILE__) . '/helper/log.php');

//回调url
$client_callback = $_GET['client_callback'];
$appid = $_GET['appid'];
//是否已经获取到用户信息
$gotuserinfo = $_GET['gotuserinfo'];
//发起授权的模式 默认为snsapi_userinfo 如果需要静默授权 需要传入snsapi_base
$scope = $_GET['scope'];

if ($gotuserinfo) {
    $openid = $_GET['openid'];

    //获取数据库中的用户信息
    $ui = new WXUserInfo($openid);
    $obj = $ui->first();
    $ui->__destruct();
    LogHelper::debug_log('获取到用户' . json_encode($obj));
    //返回用户的Openid
    $url = "$client_callback?userinfo=" . json_encode($obj);
    LogHelper::debug_log("最终回调到客户端：$url");
    header("Location:$url");

} else {
    $baseuri = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=";
    //授权后跳转页面
    $redirect_uri = BASEURL . "code.php?client_callback=$client_callback";
    $redirect_uri = urlencode($redirect_uri);

    $component_appid = COMPONENT_APPID;
    //默认为显示授权 如果需要静默授权请传入 snsapi_base
    if (!$scope) {
        $scope = "snsapi_userinfo";
    }
    $url = $baseuri . $appid
        . "&redirect_uri=$redirect_uri&response_type=code&scope=$scope&component_appid=$component_appid#wechat_redirect";
    header("Location:$url");
}
//snsapi_base