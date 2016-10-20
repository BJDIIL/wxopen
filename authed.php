<?php
/**
 * 获取到预授权码后，跳转到此处
 * @author liushuai <849351660@qq.com>
 * DateTime 2016年9月22日18:26:59
 */


include_once(dirname(__FILE__) . '/config.php');
$authinfo = array(
    'auth_code' => $_GET['auth_code'],
    'expires_in' => $_GET['expires_in']);

file_put_contents('cache/auth_code.json', json_encode($authinfo));

//此外的url为授权成功后的回调地址，修改成你自己的实际地址
$url = $_SERVER['REQUEST_SCHEME'] . '://'
    . $_SERVER['HTTP_HOST'] . '/' . SUBDIR
    . '/wxopen.php?auth_code='
    . $_GET['auth_code'] . '&start=sss';

header("Location:$url");
