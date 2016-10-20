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

class AuthorizerAccessToken extends ModelBase
{
    public $authorizer_appid;
    public $authorizer_access_token;
    public $authorizer_refresh_token;
    public $expires_in;
    public $func_info;


    public function __construct($appid,
                                $authorizer_access_token = null,
                                $authorizer_refresh_token = null,
                                $func_info = null,
                                $expires_in = null)
    {
        parent::__construct();
        $this->table_name = 'authorizer_access_token';
        $this->primary_key = 'authorizer_appid';
        $this->primary_key_value = $appid;
        $this->authorizer_appid = $appid;
        $this->authorizer_access_token = $authorizer_access_token;
        $this->authorizer_refresh_token = $authorizer_refresh_token;
        $this->func_info = $func_info;
        $this->expires_in = $expires_in;
    }

    public function initData()
    {
        $data['authorizer_appid'] = $this->authorizer_appid;
        $data['authorizer_access_token'] = $this->authorizer_access_token;
        $data['expires_in'] = $this->expires_in;
        $data['authorizer_refresh_token'] = $this->authorizer_refresh_token;
        if ($this->func_info != null) {
            $data['func_info'] = $this->func_info;
        }
        return $data;
    }
}