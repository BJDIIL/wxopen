<?php
/**
 * 公众号授权第三方公众平台页
 *
 * @copyright Copyright (c) 1998-2016.
 * Author：liushuai 849351660@qq.com
 * Date: 2015-12-24 11:46:34
 */
// 包含start参数时 跳转到微信授权页
include_once(dirname(__FILE__) . '/wxsdk/auth.class.php');
include_once(dirname(__FILE__) . '/config.php');
include_once(dirname(__FILE__) . '/helper/log.php');
include_once(dirname(__FILE__) . '/models/ComponentVerifyTicket.php');
if ($_GET['start']) {
    LogHelper::debug_log('开始授权准备');
    $cvt = new ComponentVerifyTicket(COMPONENT_APPID);
    $obj = $cvt->first();
    LogHelper::debug_log('获取component_verify_ticket' . json_encode($obj));
    $options = array(
        'component_appid' => COMPONENT_APPID,
        'component_appsecret' => COMPONENT_APPSECRET,
        'component_verify_ticket' => $obj->componentverifyticket,
    );

    $weObj = new Auth($options);

    //获取授权code
    $auth_code = $_GET['auth_code'];
    // 未获取到code时发起授权
    if (empty($auth_code)) {
        LogHelper::debug_log('$auth_code is null 开始获取auth_code');
        //此外示例代授权发起
        $code = $weObj->get_auth_code();
        if ($code == false) {
            exit("获取pre_auth_code失败！");
        }
        LogHelper::debug_log('获取到code:' . $code);
        //此外的url为授权成功后的回调地址，修改成你自己的实际地址
        $url = $_SERVER['REQUEST_SCHEME'] . '://'
            . $_SERVER['HTTP_HOST'] . '/' . SUBDIR . '/authed.php';
        $url = $weObj->getRedirect($url, $code);
        header("Location:$url");
        die;
    } else {
        //此外示例代授权回调后获取公众号信息
        $wechats_info = $weObj->get_authorization_info($auth_code);//获取授权方信息
        var_dump($wechats_info);
        LogHelper::debug_log(json_encode($wechats_info));

    }
} else { // 不包含start参数时 显示授权页
    echo '<link type="text/css" rel="stylesheet" href="resources/css/style.css" />';
    echo '<a class="button" style="top:60px; position:absolute; left:60px;"'
        . ' href="/master-up/wxopen.php?start=sss">Auth</a>';
}