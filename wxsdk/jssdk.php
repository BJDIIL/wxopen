<?php

include_once(dirname(__FILE__) . '/../models/JsapiTicket.php');
include_once(dirname(__FILE__) . '/../models/ComponentVerifyTicket.php');
include_once(dirname(__FILE__) . '/../config.php');
include_once(dirname(__FILE__) . '/auth.class.php');

class JSSDK
{
    private $appId;
    private $url;

    public function __construct($appId, $url)
    {
        $this->appId = $appId;
        $this->url = $url;
    }

    public function getSignPackage()
    {
        $jsapiTicket = $this->getJsApiTicket();

        $timestamp = time();
        $nonceStr = $this->createNonceStr();

        // 这里参数的顺序要按照 key 值 ASCII 码升序排序
        $string = "jsapi_ticket=$jsapiTicket&noncestr=$nonceStr&timestamp=$timestamp&url=$this->url";
        $signature = sha1($string);

        $signPackage = array(
            "appId" => $this->appId,
            "nonceStr" => $nonceStr,
            "timestamp" => $timestamp,
            "url" => $this->url,
            "signature" => $signature,
            "rawString" => $string,
        );
        return $signPackage;
    }

    private function createNonceStr($length = 16)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str = "";
        for ($i = 0; $i < $length; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }

    private function getJsApiTicket()
    {
        // jsapi_ticket 应该全局存储与更新，以下代码以写入到文件中做示例
        $jt = new JsapiTicket($this->appId);
        $obj = $jt->first();
        $jt->__destruct();

        if ($obj->expires_in < time()) {

            $cvt = new ComponentVerifyTicket(COMPONENT_APPID);
            $obj = $cvt->first();
            $cvt->__destruct();

            $component_verify_ticket = $obj->componentverifyticket;
            $options = array(
                'component_appid' => COMPONENT_APPID,
                'component_appsecret' => COMPONENT_APPSECRET,
                'component_verify_ticket' => $component_verify_ticket,
            );

            $weObj = new Auth($options);

            $accessToken = $weObj->get_authorizer_access_token($this->appId);

            // 如果是企业号用以下 URL 获取 ticket
            // $url = "https://qyapi.weixin.qq.com/cgi-bin/get_jsapi_ticket?access_token=$accessToken";

            $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=$accessToken&type=jsapi";

            $res = json_decode($this->httpGet($url));

            $ticket = $res->ticket;
            if ($ticket) {
                $jt = new JsapiTicket($this->appId, $ticket, $res->expires_in);
                $jt->add();
                $jt->__destruct();
            }
        } else {
            $ticket = $obj->ticket;
        }
        return $ticket;
    }


    private function httpGet($url)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 500);
        // 为保证第三方服务器与微信服务器之间数据传输的安全性，所有微信接口采用https方式调用，必须使用下面2行代码打开ssl安全校验。
        // 如果在部署过程中代码在此处验证失败，请到 http://curl.haxx.se/ca/cacert.pem 下载新的证书判别文件。
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, true);
        curl_setopt($curl, CURLOPT_URL, $url);

        $res = curl_exec($curl);
        curl_close($curl);

        return $res;
    }

    private function get_php_file($filename)
    {
        return trim(substr(file_get_contents($filename), 15));
    }

    private function set_php_file($filename, $content)
    {
        $fp = fopen($filename, "w");
        fwrite($fp, "<?php exit();?>" . $content);
        fclose($fp);
    }
}

