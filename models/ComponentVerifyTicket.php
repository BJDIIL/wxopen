<?php

/**
 * ComponentVerifyTicket 实体类.
 * @author liushuai <849351660@qq.com>
 * Date: 2016.9.22
 * Time: 10:39
 */
include_once(dirname(__FILE__) . '/../helper/db.php');
include_once(dirname(__FILE__) . '/../helper/log.php');
include_once(dirname(__FILE__) . '/ModelBase.php');

class ComponentVerifyTicket extends ModelBase
{
    public $component_appid;
    public $componentverifyticket;
    public $infotype;
    public $createtime;

    public function __construct($appid, $component_verify_ticket = null, $infotype = null, $createtime = null)
    {
        parent::__construct();
        $this->table_name = 'component_verify_ticket';
        $this->primary_key = 'component_appid';
        $this->primary_key_value = $appid;
        $this->component_appid = $appid;
        $this->componentverifyticket = $component_verify_ticket;
        $this->infotype = $infotype;
        $this->createtime = $createtime;
    }

    public function initData()
    {
        $data['component_appid'] = $this->component_appid;
        $data['componentverifyticket'] = $this->componentverifyticket;
        $data['infotype'] = $this->infotype;
        $data['createtime'] = $this->createtime;
        return $data;
    }

    
}