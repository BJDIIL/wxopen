<?php

/**
 * WXUserInfo 实体类.
 * @author liushuai <849351660@qq.com>
 * datetime 2016年9月23日20:04:57
 */
include_once(dirname(__FILE__) . '/ModelBase.php');

class WXUserInfo extends ModelBase
{
    public $openid;
    public $nickname;
    public $sex;
    public $province;
    public $city;
    public $country;
    public $headimgurl;
    public $privilege;
    public $unionid;
    public $expires_in;
    public $appid;

    public function __construct($openid, $unionid = null, $nickname = null, $sex = null,
                                $province = null, $city = null, $country = null, $headimgurl = null,
                                $privilege = null, $expires_in = null, $appid = null)
    {
        parent::__construct();
        $this->table_name = 'wx_userinfo';
        $this->primary_key = 'openid';
        $this->primary_key_value = $openid;

        $this->unionid = $unionid;
        $this->openid = $openid;
        $this->nickname = $nickname;
        $this->sex = $sex;
        $this->province = $province;
        $this->city = $city;
        $this->country = $country;
        $this->headimgurl = $headimgurl;
        $this->privilege = $privilege;
        $this->expires_in = $expires_in;
        $this->appid = $appid;
    }

    public function initData()
    {
        $data['unionid'] = $this->unionid;
        $data['openid'] = $this->openid;
        $data['nickname'] = $this->nickname;
        $data['sex'] = $this->sex;
        $data['province'] = $this->province;
        $data['city'] = $this->city;
        $data['country'] = $this->country;
        $data['headimgurl'] = $this->headimgurl;
        $data['privilege'] = $this->privilege;
        $data['expires_in'] = $this->expires_in;
        $data['appid'] = $this->appid;

        return $data;
    }
}