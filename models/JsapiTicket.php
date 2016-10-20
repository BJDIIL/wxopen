<?php

/**
 * ComponentAccessToken 实体类.
 * User: Administrator
 * Date: 2016.9.22
 * Time: 15:40
 */
include_once(dirname(__FILE__) . '/../helper/db.php');
include_once(dirname(__FILE__) . '/ModelBase.php');

class JsapiTicket extends ModelBase
{
    public $authorizer_appid;
    public $ticket;
    public $expires_in;

    public function __construct($appid, $ticket = null, $expires_in = null)
    {
        parent::__construct();
        $this->table_name = 'jsapi_ticket';
        $this->primary_key = 'authorizer_appid';
        $this->primary_key_value = $appid;

        $this->authorizer_appid = $appid;
        $this->ticket = $ticket;
        $this->expires_in = $expires_in;
    }

    public function initData()
    {
        $data['authorizer_appid'] = $this->authorizer_appid;
        $data['ticket'] = $this->ticket;
        $data['expires_in'] = $this->expires_in;
        return $data;
    }

}