<?php
include_once(dirname(__FILE__) . '/wxsdk/wxBizMsgCrypt.php');
include_once(dirname(__FILE__) . '/config.php');
include_once(dirname(__FILE__) . '/helper/log.php');
include_once(dirname(__FILE__) . '/helper/db.php');
include_once(dirname(__FILE__) . '/models/ComponentVerifyTicket.php');
/**
 * 接收component_verify_ticket 微信Server每10分调用一次
 *
 * @copyright Copyright (c) 1998-2016
 * Author：liushuai 849351660@qq.com
 * DateTime: 2016年9月21日10:25:40
 */

// 获取POST数据
$content = file_get_contents("php://input");
//LogHelper::debug_log('revice.php 获取到的数据：' . $content);

$timeStamp = $_GET['timestamp'];
$nonce = $_GET['nonce'];
$msg_sign = $_GET['msg_signature'];
$encryptMsg = $content;

$msg = "初始化WXBizMsgCrypt的参数信息:Token " . TOKEN
    . ' ENCODINGAESKEY ' . ENCODINGAESKEY
    . ' COMPONENT_APPID ' . COMPONENT_APPID;
//LogHelper::debug_log($msg);
// 对信息进行解密
$pc = new WXBizMsgCrypt(TOKEN, ENCODINGAESKEY, COMPONENT_APPID);
$xml_tree = new DOMDocument();
$xml_tree->loadXML($encryptMsg);
$array_e = $xml_tree->getElementsByTagName('Encrypt');
$encrypt = $array_e->item(0)->nodeValue;
$format = "<xml><ToUserName><![CDATA[toUser]]></ToUserName><Encrypt><![CDATA[%s]]></Encrypt></xml>";
$from_xml = sprintf($format, $encrypt);
//第三方收到公众号平台发送的消息
$msg = '';
$errCode = $pc->decryptMsg($msg_sign, $timeStamp, $nonce, $from_xml, $msg);
//LogHelper::debug_log('解密后的信息' . $msg);
if ($errCode == 0) {
    $xml = new DOMDocument();
    $xml->loadXML($msg);
    $array_a = $xml->getElementsByTagName('CreateTime');
    $createtime = $array_a->item(0)->nodeValue;
    $array_e = $xml->getElementsByTagName('ComponentVerifyTicket');
    $component_verify_ticket = $array_e->item(0)->nodeValue;
    $array_b = $xml->getElementsByTagName('InfoType');
    $infotype = $array_b->item(0)->nodeValue;
    $array_c = $xml->getElementsByTagName('AuthorizerAppid');
    $authorizerappid = $array_c->item(0)->nodeValue;
    $array_d = $xml->getElementsByTagName('AppId');
    $appid = $array_d->item(0)->nodeValue;
    //记录解密的xml数据
    if ($infotype == 'unauthorized') {//取消授权做判断处理
        echo 'success';
    }
    if ($component_verify_ticket) {
        LogHelper::debug_log('获取到$component_verify_ticket：' . $component_verify_ticket);

        try {
            $model = new ComponentVerifyTicket($appid, $component_verify_ticket, $infotype, $createtime);
            $model->add();
            LogHelper::debug_log('更新或添加$component_verify_ticket成功');
        } catch (Exception $e) {
            LogHelper::debug_log($e->getMessage() . $e->getTraceAsString());
        }


        // 告知微信服务器 接受成功
        echo 'success';
    }
}

echo 'faild';