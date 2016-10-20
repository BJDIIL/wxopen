<?php

/**
 * ComponentAccessToken 实体类.
 * User: Administrator
 * Date: 2016.9.22
 * Time: 15:40
 */
include_once(dirname(__FILE__) . '/ModelBase.php');

class ApreAuthCode extends ModelBase
{
    public $component_appid;
    public $pre_auth_code;
    public $expires_in;

    public function __construct($appid, $pre_auth_code = null, $expires_in = null)
    {
        parent::__construct();
        $this->table_name = 'apre_auth_code';
        $this->primary_key = 'component_appid';
        $this->primary_key_value = $appid;

        $this->component_appid = $appid;
        $this->pre_auth_code = $pre_auth_code;
        $this->expires_in = $expires_in;
    }

    public function initData()
    {
        $data['component_appid'] = $this->component_appid;
        $data['pre_auth_code'] = $this->pre_auth_code;
        $data['expires_in'] = $this->expires_in;
        return $data;
    }
}