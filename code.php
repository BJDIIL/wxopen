<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015.12.24
 * Time: 11:56
 */
//redirect_uri?code=CODE&state=STATE&appid=APPID
include_once(dirname(__FILE__) . '/wxsdk/auth.class.php');
include_once(dirname(__FILE__) . '/config.php');
include_once(dirname(__FILE__) . '/models/ComponentVerifyTicket.php');
include_once(dirname(__FILE__) . '/models/WXUserInfo.php');
include_once(dirname(__FILE__) . '/helper/log.php');

header('conten-type:textml;charset=utf-8');
$code = $_GET['code'];
$state = $_GET['state'];
$appid = $_GET['appid'];
$client_callback = $_GET['client_callback'];

// 获取数据库中的componentverifyticket
$cvt = new ComponentVerifyTicket(COMPONENT_APPID);
$obj = $cvt->first();
$cvt->__destruct();

$options = array(
    'component_appid' => COMPONENT_APPID,
    'component_appsecret' => COMPONENT_APPSECRET,
    'component_verify_ticket' => $obj->componentverifyticket,
);
//生成component_access_token用于后续请求
$weObj = new Auth($options);
$component_access_token = $weObj->get_access_token();

$url = 'https://api.weixin.qq.com/sns/oauth2/component/access_token?appid=' . $appid
    . '&code=' . $code
    . '&grant_type=authorization_code&component_appid=' . COMPONENT_APPID
    . '&component_access_token=' . $component_access_token;

$content = file_get_contents($url);

$json = json_decode($content, true);
$openid = $json['openid'];
// 查询本地数据库是否存在用户信息
$ui = new WXUserInfo($openid);
$user = $ui->first();
$ui->__destruct();

//存在则返回到上一页面 userinfoservice.php
if ($user) {
    LogHelper::debug_log("数据库中缓存的用户信息：" . json_encode($user));
    $callbackurl = BASEURL . "userinfoservice.php?gotuserinfo=true&openid=$openid&appid=$appid&client_callback=$client_callback";
    LogHelper::debug_log('返回到userinfoservice.php:' . $callbackurl);
    header("Location:$callbackurl");
}

// 不存在用户信息则发起获取用户信息的请求
$access_token = $json['access_token'];
$url = 'https://api.weixin.qq.com/sns/userinfo?access_token=' . $access_token
    . '&openid=' . $openid . '&lang=zh_CN';

$userinfo = $weObj->http_get($url);
$uinfoobj = json_decode($userinfo);

// 如果存在errcode 则说明获取用户信息失败
if ($uinfoobj->errcode) {
    $url = $client_callback . "?nofocus=true";
    header("Location:$url");
}

//保存用户信息到本地数据库
$ui = new WXUserInfo($uinfoobj->openid, $uinfoobj->unionid, $uinfoobj->nickname, $uinfoobj->sex,
    $uinfoobj->province, $uinfoobj->city, $uinfoobj->country, $uinfoobj->headimgurl,
    json_encode($uinfoobj->privilege), time() + 7000, $appid);
$r = $ui->add();
$ui->__destruct();

// 插入成功后 返回到上一页面
if ($r) {
    $url = BASEURL . "userinfoservice.php?gotuserinfo=true&openid=$openid&appid=$appid&client_callback=$client_callback";
    header("Location:$callbackurl");
} else {
    echo "insert faild";
}
