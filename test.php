<?php
////用户定义变量
//$logfile = "clf.log"; //LOG文件名
//$timezone = "+0100";
//$lookup_size = true; //设置文件权限
//$document_root = "/htdocs";//log存储路径
////要对$document_root进行设置
//function write_to_log($str)
//{
//    if ($fd = @fopen($GLOBALS["logfile"], "a")) {
//        fputs($fd, $str);
//        fclose($fd);
//    }
//}
//
//function get_var($name, $default)
//{
//    if ($var = getenv($name)) {
//        return $var;
//    } else {
//        return $default;
//    }
//}
//
//if ($remote_host = get_var("REMOTE_HOST", false)) {
//    $remote_host = get_var("REMOTE_ADDR", "-");
//}
//$remote_user = get_var("REMOTE_USER", "-");
//$remote_ident = get_var("REMOTE_IDENT", "-");
//$server_port = get_var("SERVER_PORT", 80);
//if ($server_port != 80) {
//    $server_port = ":" . $server_port;
//} else {
//    $server_port = "";
//}
//$server_name = get_var("SERVER_NAME", "-");
//$request_method = get_var("REQUEST_METHOD", "GET");
//$request_uri = get_var("REQUEST_URI", "");
//$user_agent = get_var("HTTP_USER_AGENT", "");
//if ($lookup_size == true && $document_root) {
//    $filename = ereg_replace("\?.*", "", $request_uri);
//    $filename = "$document_root$filename";
//    if (!$size = filesize($filename)) {
//        $size = 0;
//    }
//} else {
//    $size = 0;
//}
//$date = gmdate("d/M/Y:H:I:s");
//$log = "$remote_host $remote_ident $remote_user [$date $timezone] \"" .
//    "$request_method http://$server_name$server_port$request_uri\" 200 $size\n";
//write_to_log($log);
//include_once("helper/db.php");
//$db = new DB();
//$sql = 'select count(1) from wx_userinfo;';
//$result = $db->pdo->exec($sql);
//echo json_encode($db->exist($sql));

include_once(dirname(__FILE__) . '/models/ComponentVerifyTicket.php');
include_once(dirname(__FILE__) . '/models/ComponentAccessToken.php');
include_once(dirname(__FILE__) . '/helper/log.php');
include_once(dirname(__FILE__) . '/config.php');
//try {
//    $model = new ComponentVerifyTicket('a'.uniqid(), 'b'.uniqid(), 'c'.uniqid(), time());
//    $model->add();
//    LogHelper::debug_log('更新或添加$component_verify_ticket成功');
//} catch (Exception $e) {
//    LogHelper::debug_log($e->getMessage() . $e->getTraceAsString());
//}

//$cvt = new ComponentVerifyTicket(COMPONENT_APPID);
//$obj = $cvt->first();
//exit(json_encode($obj));

try {
    $model = new ComponentAccessToken('a' . uniqid(), 'b' . uniqid(), time());
    $model->add();
    LogHelper::debug_log('更新或添加ComponentAccessToken成功');
} catch (Exception $e) {
    LogHelper::debug_log($e->getMessage() . $e->getTraceAsString());
}


//echo time() - 600;
//var_dump($_SERVER);
