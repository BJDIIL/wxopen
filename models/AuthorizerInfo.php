<?php

/**
 * ComponentAccessToken 实体类.
 * User: Administrator
 * Date: 2016.9.22
 * Time: 15:40
 */
include_once(dirname(__FILE__) . '/../helper/db.php');
include_once(dirname(__FILE__) . '/../helper/log.php');
include_once(dirname(__FILE__) . '/ModelBase.php');

class AuthorizerInfo extends ModelBase
{
    public $component_appid;
    public $pre_auth_code;
    public $expires_in;

    public function __construct($appid, $pre_auth_code = null, $expires_in = null)
    {
        parent::__construct();
        $this->table_name = 'authorizer_info';
        $this->primary_key = 'component_appid';
        $this->primary_key_value = $appid;
        $this->component_appid = $appid;
        $this->pre_auth_code = $pre_auth_code;
        $this->expires_in = $expires_in;
    }

    public function initData()
    {
        // TODO: Implement initData() method.
        $data['compo$nent_appid'] = $this->component_appid;
        $data['pre_auth_code'] = $this->pre_auth_code;
        $data['expires_in'] = $this->expires_in;
        return $data;
    }
}