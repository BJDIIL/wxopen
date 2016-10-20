<?php

/**
 * ComponentAccessToken 实体类.
 * User: Administrator
 * Date: 2016.9.22
 * Time: 15:40
 */
include_once(dirname(__FILE__) . '/../helper/db.php');
include_once(dirname(__FILE__) . '/ModelBase.php');

class ComponentAccessToken extends ModelBase
{
    public $component_appid;
    public $component_access_token;
    public $expires_in;

    public function __construct($appid, $component_access_token = null, $expires_in = null)
    {
        parent::__construct();
        $this->table_name = 'component_access_token';
        $this->primary_key = 'component_appid';
        $this->primary_key_value = $appid;

        $this->component_appid = $appid;
        $this->component_access_token = $component_access_token;
        $this->expires_in = $expires_in;
    }

    public function initData()
    {
        $data['component_appid'] = $this->component_appid;
        $data['component_access_token'] = $this->component_access_token;
        $data['expires_in'] = $this->expires_in;
        return $data;
    }
}