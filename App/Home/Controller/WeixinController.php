<?php

/**
 * 微信Api
 * Class WeixinController
 */
class WeixinController
{
    private $WxObj;
    private $appid = "wx9d57e78b5bda6755";
    private $appsecret = "766f02a79683557a23cbaed0fc9024d5";

    public function index()
    {
        $token = 'atshike';
        //验证
        $this->verify($token);
        //获取消息
        $WxObj = $this->getWxObj();
        $this->WxObj = $WxObj;
        //关注
        if ($this->isSubscribe()) {
            $this->responseMsg('欢迎您关注！\n回复1：显示最新新闻\n回复2：显示最新活动\n回复3：显示地图\n我的主页：www.obo1.com');
        }
        //回复
        if ($this->isText()) {
            switch (trim($this->WxObj->Content)) {
                case '1':
                    $this->responseMsg('1:新闻');
                    break;
                case '2':
                    $this->responseMsg($this->news());
                    break;
                default:
                    $this->responseMsg('请输入点什么吧！');
                    break;
            }
        }
    }

    /**
     * 获取accessToken
     */
    private function getaccessToken()
    {
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=" . $this->appid . "&secret=" . $this->appsecret;
        $output = $this->https_request($url);
        $jsoninfo = json_decode($output, true);
        $access_token = $jsoninfo["access_token"];
        $jsonmenu = '{
    "button":[
    {
        "name":"程序开发",
       "sub_button":[
        {
           "type":"view",
           "name":"PHP开发",
           "url":"http://www.obo1.com/"
        },
        {
           "type":"view",
           "name":"laravel开发",
           "url":"http://www.obo1.com/"
        }]
    },
    {
       "name":"Web前端",
       "sub_button":[
        {
           "type":"view",
           "name":"CSS",
           "url":"http://www.obo1.com/"
        },
        {
           "type":"view",
           "name":"Jquery",
           "url":"http://www.obo1.com/"
        }]
    },{
        "type": "scancode_push", 
        "name": "扫一扫", 
        "key": "rselfmenu_0_1", 
        "sub_button": []
      }
    ]
 }';
        $url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=" . $access_token;
        $result = $this->https_request($url, $jsonmenu);
        return $result;
    }


    /**
     * 关注事件
     */
    private function isSubscribe()
    {
        if ($this->WxObj->MsgType == 'event') {
            if ($this->WxObj->Event == 'subscribe') {
                return true;
            }
        }
        return false;
    }

    /**
     * 返回文本数据
     */
    private function responseMsg($msg)
    {
        $WxObj = $this->WxObj;
        $toUser = $WxObj->FromUserName;
        $fromUser = $WxObj->ToUserName;
        $time = time();
        $str = <<<str
        <xml>
         <ToUserName><![CDATA[{$toUser}]]></ToUserName>
         <FromUserName><![CDATA[{$fromUser}]]></FromUserName>
         <CreateTime>{$time}</CreateTime>
         <MsgType><![CDATA[text]]></MsgType>
         <Content><![CDATA[{$msg}]></Content>
         </xml>
str;
        echo $str;
        die;


    }

    /**
     * 获取消息类型
     */
    private function isText()
    {
        if ($this->WxObj->MsgType == 'text') {
            return true;
        }
        return false;
    }

    /**
     * 获取消息
     */
    private function getWxObj()
    {
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        file_put_contents('xml.php', $postStr);//
        libxml_disable_entity_loader(true);
        $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
        return $postObj;
    }

    /**
     * 验证
     * @param $token
     * @return bool
     * http://www.abc.com/weixin/index.php?action=index
     */
    private function verify($token)
    {
        $echoStr = $_GET["echostr"];
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);
        if ($tmpStr == $signature && isset($_GET['echoStr'])) {
            echo $echoStr;
        } else {
            return false;
        }
    }


    /**
     * @return mysqli
     */
    private function conn()
    {
        mysqli_query('SET NAMES utf8');
        $con = mysqli_connect("localhost", "root", ".", "test");
        return $con;
    }


    /**
     * 最新信息
     * @return string
     */
    private function news()
    {
        $con = $this->conn();
        $sql = "select title from archives ORDER BY id desc limit 5";
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
            $rows = array();
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row['title'];
            }
        }
        return "$rows[0] \n $rows[1] \n $rows[2] \n $rows[3] \n $rows[4]";
    }

    private function https_request($url, $data = null)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        if (!empty($data)) {
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
    }


}
