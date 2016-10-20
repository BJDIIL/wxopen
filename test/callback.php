<?php
/**
 * 获取用户信息回调接口.
 * 建议将用户信息保存到项目的数据库，进行独立管理
 * @author liushuai <849351660@qq.com>
 * Date: 2016.9.23
 * Time: 19:41
 */
if (isset($_GET['userinfo'])) {
    $json = $_GET['userinfo'];
    var_dump($json);
    // 建议保存到项目的数据库，进行独立管理

}