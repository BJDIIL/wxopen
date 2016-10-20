<?php
/**
 * 初始化.
 * @author liushuai <849351660@qq.com>
 * Date: 2016.9.21
 * Time: 15:31
 */
include_once(dirname(__FILE__) . '/helper/log.php');
include_once(dirname(__FILE__) . '/config.php');
function initDB()
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PWD, null, DB_PORT) or die ('Not connected : ' . mysqli_connect_error());
    if (!@mysqli_select_db($link, DB_NAME)) {
        LogHelper::debug_log('创建数据库');
        @mysqli_query($link, "CREATE DATABASE " . DB_NAME);
        if (@mysqli_error($link)) {
            LogHelper::debug_log('链接出现错误,退出');
            exit;
        } else {
            mysqli_select_db($link, DB_NAME);
        }
    } else {
        LogHelper::debug_log('数据库已经安装过');
    }

    if (file_exists(SQLFILEPATH)) {
        LogHelper::debug_log('创建数据库结构和数据' . SQLFILEPATH);
        $sql = file_get_contents(SQLFILEPATH);
        //LogHelper::debug_log('数据库脚本内容' . $sql);
        $result = @mysqli_multi_query($link, $sql);
        LogHelper::debug_log('数据库脚本执行结果' . $result);
    } else {
        LogHelper::debug_log('数据库脚本文件不存在');
    }
}

initDB();