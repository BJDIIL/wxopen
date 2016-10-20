<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016.9.21
 * Time: 10:37
 */
include_once(dirname(__FILE__) . "/../config.php");

class LogHelper
{
    /**
     * 将调试信息写到log文件中
     */
    public static function debug_log($msg, $file_path = null)
    {
        if ($file_path == null) {
            $file_path = dirname(__FILE__) . '/../' . DEBUGLOGFILEPATH;
        }
        //echo $file_path;
        file_put_contents($file_path, date('Y/m/d H:i:s') . '-->' . $msg . PHP_EOL, FILE_APPEND);
    }
}