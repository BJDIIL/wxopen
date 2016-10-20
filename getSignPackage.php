<?php
/**
 * 获取Sign Package.
 * @author liushuai <849351660@qq.com>
 * Date: 2015.12.23
 * Time: 15:30
 */
include_once(dirname(__FILE__) . '/wxsdk/jssdk.php');
header('Content-type: application/json');
$callback = $_GET['jsoncallback'];
$jssdk = new JSSDK($_GET['appid'], $_GET['url']);
$signPackage = $jssdk->GetSignPackage();
//var_dump($signPackage);
echo $callback . "(" . json_encode($signPackage) . ")";
