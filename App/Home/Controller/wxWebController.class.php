<?php

/**
 * Class WxcountAction
 * 统计分享次数 、朋友圈进入多少、公众号自身粉丝的点击次数
 * atshike
 */
class WxcountAction extends CommonAction
{
    const appId = 'wx9d57e78b5bda6000';
    const appSecret = '766f02a79683557a23cbaed0fc902000';

    public function index()
    {
        $signpack = $this->getSignPackage();
        $this->friendVisitorNumTount($signpack);
        $this->assign('signpack', $signpack);
        $this->display();
    }

    /**
     * @return array
     */
    private function getSignPackage()
    {
        $jsapiTicket = $this->getJsApiTicket();
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $url = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $timestamp = time();
        $nonceStr = $this->createNonceStr();
        $string = "jsapi_ticket=$jsapiTicket&noncestr=$nonceStr&timestamp=$timestamp&url=" . $url;
        $signature = sha1($string);
        $wxid = $this->getWxId();
        $shareurl = $this->getUrl($wxid);
        $signPackage = array(
            "appId" => self::appId,
            "nonceStr" => $nonceStr,
            "timestamp" => $timestamp,
            "url" => $shareurl,
            "signature" => $signature,
            "rawString" => $string,
            "wxid" => $wxid
        );
        return $signPackage;
    }

    /**
     * 获取微信ID
     */
    public function getWxId()
    {
        $code = $_GET['code'];
        if (empty($code)) {
            $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
            $cfg_oauth_cb_url = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=' . self::appId . '&redirect_uri=' . urlencode($cfg_oauth_cb_url) . '&response_type=code&scope=snsapi_base&state=blinq#wechat_redirect';
            header("Location:" . $url);
            exit;
        } else {
            $json = file_get_contents('https://api.weixin.qq.com/sns/oauth2/access_token?appid=' . self::appId . '&secret=' . self::appSecret . '&code=' . $code . '&grant_type=authorization_code');
            $arr = json_decode($json, true);
            return $arr['openid'];
        }
    }

    /**
     * 分享后的URL解析
     * @param $url
     * @return string
     */
    private function getUrl($openid)
    {
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $url = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $arr = explode("?", $url);
        if ($arr[1]) {
            $arrnew = explode("&", $arr[1]);
            foreach ($arrnew as $key => $val) {
                $arrnew = explode("=", $val);
                if ($arrnew[1] == $openid) {
                    return $url;
                }
                $newurl = $arr[0] . "?wxid=" . $openid;
                return $newurl;
            }
        }
        $newurl = $arr[0] . "?wxid=" . $openid;
        return $newurl;
    }

    /**
     * 随机字符串，处理签名
     * @param int $length
     * @return string
     */
    private function createNonceStr($length = 16)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str = "";
        for ($i = 0; $i < $length; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }

    /**
     * 签名算法组成之一
     * @return mixed
     */
    private function getJsApiTicket()
    {
        $jsapiticket = "./Public/jsapi_ticket.php";   //缓存文件名
        $data = json_decode($this->get_php_file($jsapiticket));
        if ($data->expire_time < time()) {
            $accessToken = $this->getAccessToken();
            $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=$accessToken";
            $res = json_decode($this->httpGet($url));
            $ticket = $res->ticket;
            if ($ticket) {
                $data->expire_time = time() + 7000;
                $data->jsapi_ticket = $ticket;
                $this->set_php_file($jsapiticket, json_encode($data));
            }
        } else {
            $ticket = $data->jsapi_ticket;
        }
        return $ticket;
    }

    /**
     * 获取微信 access_token
     * @return mixed
     */
    private function getAccessToken()
    {
        $tokenFile = "./Public/access_token.php";   //缓存文件名
        $data = json_decode($this->get_php_file($tokenFile));
        if ($data->expire_time < time()) {
            $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=" . self::appId . "&secret=" . self::appSecret;
            $res = json_decode($this->httpGet($url));
            $access_token = $res->access_token;
            if ($access_token) {
                $data->expire_time = time() + 7000;
                $data->access_token = $access_token;
                $this->set_php_file($tokenFile, json_encode($data));
            }
        } else {
            $access_token = $data->access_token;
        }
        return $access_token;
    }

    /**
     * for getAccessToken
     * @param $url
     * @return mixed
     */
    private function httpGet($url)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 500);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, true);
        curl_setopt($curl, CURLOPT_URL, $url);
        $res = curl_exec($curl);
        curl_close($curl);
        return $res;
    }

    /**
     * for getAccessToken
     * @param $filename
     * @return string
     */
    private function get_php_file($filename)
    {
        return trim(substr(file_get_contents($filename), 15));
    }

    /**
     * for getAccessToken
     * @param $filename
     * @param $content
     */
    private function set_php_file($filename, $content)
    {
        $fp = fopen($filename, "w");
        fwrite($fp, "<?php exit();?>" . $content);
        fclose($fp);
    }

    /**
     * 统计分享次数
     * @field sid、userid、indate、url、wxid
     */
    public function getshareNum()
    {
        if (IS_POST) {
            $m = M('wx_share');
            $condition['userid'] = $_POST['userid'];
            $condition['wxid'] = $_POST['wxid'];
            $condition['_logic'] = 'OR';
            $map['_complex'] = $condition;
            $map['indate'] = date('Y-m-d');
            $result = $m->where($map)->select();
            if (!$result) {
                $date['userid'] = $_POST['userid'];
                $date['wxid'] = $_POST['wxid'];
                //$date['url'] = $_POST['url'];
                $date['sharenum'] = 1;
                $date['indate'] = date('Y-m-d', time());
                $m->add($date);
                return true;
            }
            foreach ($result as $vel) {
                $sharenum = $vel['sharenum'] + 1;
            }
            $data['sharenum'] = $sharenum;
            $date['indate'] = date('Y-m-d', time());
            $m->where($map)->save($data);
        }
    }

    /**
     * 判断微信浏览器
     * @return bool
     */
    private function isWeixin()
    {
        if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false) {
            return true;
        }
        exit;
    }

    /**
     * 访客/粉丝统计
     */
    private function friendVisitorNumTount($signpack)
    {
        $this->isWeixin();
        $url = $signpack['url'];
        $arr = explode("?", $url);
        if ($arr[1]) {
            $arrnew = explode("&", $arr[1]);
            foreach ($arrnew as $key => $val) {
                $arrnew = explode("=", $val);
                if ($key == 'weixin') {
                    $wxid = $arrnew[1];
                }
            }
        }
        if ($wxid) {
            $m = M('wx_share');
            $map['wxid'] = $wxid;
            $map['indate'] = date('Y-m-d', time());
            $where['openid'] = $wxid;
            $results = $m->where($map)->field('sharenum,clicknum,fannum')->select();
            $arr = array();
            foreach ($results as $result) {
                $arr['clicknum'] = intval($result['clicknum']);
                $arr['fannum'] = intval($result['fannum']);
                $arr['sharenum'] = $result['sharenum'];
            }
            if ($arr['sharenum']) {
                $fans = M('wxlogin_temp')->where($where)->getField('openid');
                if (!$result && !$fans) {
                    $data['clicknum'] = 1;
                    $data['wxid'] = $wxid;
                    $data['indate'] = date('Y-m-d', time());
                    $m->where($map)->add($data);
                } elseif (!$result && $fans) {
                    $data['clicknum'] = 1;
                    $data['fannum'] = 1;
                    $data['wxid'] = $wxid;
                    $data['indate'] = date('Y-m-d', time());
                    $m->where($map)->add($data);
                } elseif ($result && !$fans) {
                    $data['clicknum'] = $arr['clicknum'] + 1;
                    $m->where($map)->save($data);
                } elseif ($result && $fans) {
                    $data['clicknum'] = $arr['clicknum'] + 1;
                    $data['fannum'] = $arr['fannum'] + 1;
                    $m->where($map)->save($data);
                }
            }
        }
    }
}
