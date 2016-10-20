<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015.12.21
 * Time: 16:28
 */

define('DB_TYPE', 'mysql'); // 数据库类型
define('DB_HOST', ''); //   'DB_HOST' => '127.0.0.1'
define('DB_NAME', '');  //  'DB_NAME' => 'qa', // 数据库名称
define('DB_USER', ''); //   'DB_USER' => 'root', // 数据库登陆名称
define('DB_PWD', '');  //  'DB_PWD' => 'root', // 登陆密码
define('DB_PORT', '3306'); //   'DB_PORT' => '3306', // 数据库端口
define('DB_CHARSET', 'utf8'); //  'DB_CHARSET' => 'utf8', // 字符集


define('COMPONENT_APPID', ''); // 第三方公众平台的微信公众号
define('COMPONENT_APPSECRET', '');
define('TOKEN', ''); // 公众号消息校验Token
define('ENCODINGAESKEY', '');//公众号消息加解密Key
define('FILENAME', './log.txt');
define('DEBUGLOGFILEPATH', 'log/debug.log');
define('SQLFILEPATH', 'wxopen.sql');
define('SUBDIR', '');
define('BASEURL','');