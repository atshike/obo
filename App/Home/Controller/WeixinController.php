<?php
/**
 * 微信Api
 */

define("TOKEN", "atshike");
$wechatObj = new wechatCallbackapiTest();
$wechatObj->inserMsg();

class wechatCallbackapiTest
{
    public function valid()
    {
        $echoStr = $_GET["echostr"];
        if ($this->checkSignature()) {
            echo $echoStr;
            exit;
        }
    }

    public function responseMsg()
    {
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        if (!empty($postStr)) {
            libxml_disable_entity_loader(true);
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $fromUsername = $postObj->FromUserName;
            $toUsername = $postObj->ToUserName;
            $keyword = trim($postObj->Content);
            $time = time();
            $textTpl = "<xml>
                        <ToUserName><![CDATA[%s]]></ToUserName>
                        <FromUserName><![CDATA[%s]]></FromUserName>
                        <CreateTime>%s</CreateTime>
                        <MsgType><![CDATA[%s]]></MsgType>
                        <Content><![CDATA[%s]]></Content>
                        <FuncFlag>0</FuncFlag>
                        </xml>";
            if (!empty($keyword)) {
                $msgType = "text";
                $contentStr = "欢迎访问我的博客！www.obo1.com";
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                echo $resultStr;
            } else {
                echo "请输入内容，查看相关信息";
            }

        } else {
            echo "发送内容为空";
            exit;
        }
    }

    /**
     * 自动回复内容
     * 接收内容，写入数据库
     */
    public function inserMsg()
    {
        $data = $GLOBALS["HTTP_RAW_POST_DATA"];
        $postObj = simplexml_load_string($data);
        if (!empty($postObj)) {
            $toUsername = $postObj->ToUserName;
            $fromUsername = $postObj->FromUserName;
            $CreateTime = $postObj->CreateTime;
            $type = $postObj->MsgType;

            /**
             * 接收数据
             * $textTpl = "<xml>
             * <ToUserName><![CDATA[%s]]></ToUserName>
             * <FromUserName><![CDATA[%s]]></FromUserName>
             * <CreateTime>%s</CreateTime>
             * <MsgType><![CDATA[%s]]></MsgType>
             * <Content><![CDATA[%s]]></Content>
             * <FuncFlag>0</FuncFlag>
             * </xml>";
             */

            if ($type == "text") {
                $Content = $postObj->Content;
                $tpl = "<xml>
                        <ToUserName><![CDATA[%s]]></ToUserName>
                        <FromUserName><![CDATA[%s]]></FromUserName>
                        <CreateTime>%s</CreateTime>
                        <MsgType><![CDATA[%s]]></MsgType>
                        <Content><![CDATA[%s]]></Content>
                        <FuncFlag>0</FuncFlag>
                        </xml>";
                $toUser = $fromUsername;
                $fromUser = $toUsername;
                $time = $CreateTime;
                $MsgType = "text";
                if ($Content == "1" || $Content == "新闻") {
                    $rep = $this->news();
                } elseif ($Content == "2" || $Content == "活动") {
                    $rep = "最新活动,此处省略3千字...";
                } elseif ($Content == "3" || $Content == "地图") {
                    $rep = "你在银河系，火星上...";
                } else {
                    $rep = "您可以发送：1/新闻：查看新闻；2/活动：查看活动；3/地图：查看当前地里位置。";
                }
                mysqli_query('SET NAMES utf8');
                $con = mysqli_connect("localhost", "root", "test.", "weixin");
                $sql = "INSERT INTO `weixin` (`id`, `touser`, `fromuser`, `createtime`, `content`) VALUES ('','$toUser','$fromUser','$time','$Content')";
                if (mysqli_query($con, $sql)) {
                    $str = sprintf($tpl, $toUser, $fromUser, $time, $MsgType, $rep);
                    if (!empty($str)) {
                        echo $str;
                    }
                }
                $id = $postObj->MsgId;
                mysqli_close($con);
            }
            /**
             * 关注事件
             */
            if ($type == "event") {
                $event = $postObj->Event;
                if ($event == "subscribe") {
                    $tpl = "<xml>
                            <ToUserName><![CDATA[%s]]></ToUserName>
                            <FromUserName><![CDATA[%s]]></FromUserName>
                            <CreateTime>%s</CreateTime>
                            <MsgType><![CDATA[%s]]></MsgType>
                            <Content><![CDATA[%s]]></Content>
                            <FuncFlag>0</FuncFlag>
                            </xml>";
                    $toUser = $fromUsername;
                    $fromUser = $toUsername;
                    $time = time();
                    $MsgType = "text";
                    $rep = "欢迎您关注！\n回复1：显示最新新闻\n回复2：显示最新活动\n回复3：显示地图\n我的主页：www.obo1.com";
                    $str = sprintf($tpl, $toUser, $fromUser, $time, $MsgType, $rep);
                    if (!empty($str)) {
                        echo $str;
                    }
                }
            }
            /**
             * 地图
             */
            if ($type == "location") {
                $Location_X = $postObj->Location_X;
                $Location_Y = $postObj->Location_Y;
                $Scale = $postObj->Scale;  //地图缩放
                $Label = $postObj->Label;  //地理位置信息

                $tpl = "<xml>
						<ToUserName><![CDATA[%s]]></ToUserName>
						<FromUserName><![CDATA[%s]]></FromUserName>
						<CreateTime>%s</CreateTime>
						<MsgType><![CDATA[%s]]></MsgType>
						<Content><![CDATA[%s]]></Content>
						<FuncFlag>0</FuncFlag>
						</xml>";
                $toUser = $fromUsername;
                $fromUser = $toUsername;
                $time = time();
                $rep = $Location_X . ":" . $Location_Y;
                $MsgType = "text";
                $str = sprintf($tpl, $toUser, $fromUser, $time, $MsgType, $rep);
                $urlstr = "http://api.map.baidu.com/place/v2/search?query=酒店&page_size=10&page_num=0&scope=1&location=34.249805,117.244446&radius=2000&output=json&ak=F7VUBhAI1LweHCw1WsLziEcxnLKGPpgG";
                $jsonstr = file_get_contents($urlstr);
                $json = json_decode($jsonstr, true);
                echo $json['message'];
            }
        }
    }

    /**
     * @param $signature
     * @param $timestamp
     * @param $nonce
     * 微信Api
     * 验证 $token
     */
    private function checkSignature()
    {
        if (!defined("TOKEN")) {
            throw new Exception('TOKEN is not defined!');
        }
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        $token = TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);
        if ($tmpStr == $signature) {
            return true;
        } else {
            return false;
        }
    }
    
    
    public function news()
    {
        $con = $this->conn();
        $sql = "select title from archives ORDER BY id desc limit 5";
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
            $rows =array();
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row['title'];
            }
        }
        return "$rows[0] \n $rows[1] \n $rows[2] \n $rows[3] \n $rows[4]";
    }

    private function conn(){
        mysqli_query('SET NAMES utf8');
        $con = mysqli_connect("localhost", "root", ".", "data");
        return $con;
    }
}

?>
