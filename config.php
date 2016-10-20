<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015.12.21
 * Time: 16:28
 */

define('DB_TYPE', 'mysql'); // 数据库类型
define('DB_HOST', 'joinusad.mysql.rds.aliyuncs.com'); //   'DB_HOST' => '127.0.0.1'
define('DB_NAME', 'wxupgrade');  //  'DB_NAME' => 'qa', // 数据库名称
define('DB_USER', 'wxopen'); //   'DB_USER' => 'root', // 数据库登陆名称
define('DB_PWD', 'ws123456');  //  'DB_PWD' => 'root', // 登陆密码
define('DB_PORT', '3306'); //   'DB_PORT' => '3306', // 数据库端口
define('DB_CHARSET', 'utf8'); //  'DB_CHARSET' => 'utf8', // 字符集


define('COMPONENT_APPID', 'wxce7a5fb2666d6e6e'); // 第三方公众平台的微信公众号
define('COMPONENT_APPSECRET', 'a81a30d6f1f435016fef531b91f5281e');
define('TOKEN', 'xiaobudian'); // 公众号消息校验Token
define('ENCODINGAESKEY', 'CKagqzvDVu2a0LbJ7YuTO3SM8Xeqy1PR0jvYgtQNiOp');//公众号消息加解密Key
define('FILENAME', './log.txt');
define('DEBUGLOGFILEPATH', 'log/debug.log');
define('SQLFILEPATH', 'wxopen.sql');
define('SUBDIR', 'master-up');
define('BASEURL','http://wx.rkastore.com/master-up/');