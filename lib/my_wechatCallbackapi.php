<?php
//微信信息回调api
class WechatCallbackapi
{
    public function valid()
    {
        $echoStr = $_GET["echostr"];
        if ($this->checkSignature()) {
            echo $echoStr;
            exit;
        }
    }

    private function checkSignature()
    {
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];

        $token = TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);

        if ($tmpStr == $signature) {
            return true;
        } else {
            return false;
        }
    }

    //请求
    public function request()
    {
        $postStr = isset($GLOBALS["HTTP_RAW_POST_DATA"]) ? $GLOBALS["HTTP_RAW_POST_DATA"] : '';
        $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
        return $postObj;
    }

    //发送
    public function response($fromUsername, $toUsername, $content = null, $type = 'text')
    {

        $time = time();
        $textTpl = '';
        $resultStr = '';
        switch ($type) {
            case 'image': //图片消息
                $textTpl = '<xml>
								<ToUserName><![CDATA[toUser]]></ToUserName>
								<FromUserName><![CDATA[fromUser]]></FromUserName>
								<CreateTime>12345678</CreateTime>
								<MsgType><![CDATA[image]]></MsgType>
								<Image>
								<MediaId><![CDATA[media_id]]></MediaId>
								</Image>
								</xml>';
                break;
            case 'voice': //语音消息
                $textTpl = '<xml>
								<ToUserName><![CDATA[toUser]]></ToUserName>
								<FromUserName><![CDATA[fromUser]]></FromUserName>
								<CreateTime>12345678</CreateTime>
								<MsgType><![CDATA[voice]]></MsgType>
								<Voice>
								<MediaId><![CDATA[media_id]]></MediaId>
								</Voice>
								</xml>';
                break;
            case 'video': //视频消息
                $textTpl = '<xml>
									<ToUserName><![CDATA[toUser]]></ToUserName>
									<FromUserName><![CDATA[fromUser]]></FromUserName>
									<CreateTime>12345678</CreateTime>
									<MsgType><![CDATA[video]]></MsgType>
									<Video>
									<MediaId><![CDATA[media_id]]></MediaId>
									<ThumbMediaId><![CDATA[thumb_media_id]]></ThumbMediaId>
									</Video> 
									</xml>';
                break;
            case 'music': //音乐消息
                $textTpl = '<xml>
									<ToUserName><![CDATA[toUser]]></ToUserName>
									<FromUserName><![CDATA[fromUser]]></FromUserName>
									<CreateTime>12345678</CreateTime>
									<MsgType><![CDATA[music]]></MsgType>
									<Music>
									<Title><![CDATA[TITLE]]></Title>
									<Description><![CDATA[DESCRIPTION]]></Description>
									<MusicUrl><![CDATA[MUSIC_Url]]></MusicUrl>
									<HQMusicUrl><![CDATA[HQ_MUSIC_Url]]></HQMusicUrl>
									<ThumbMediaId><![CDATA[media_id]]></ThumbMediaId>
									</Music>
									</xml>';
                break;
            case 'news': //图文消息
                $textTpl = '<xml>
									<ToUserName><![CDATA[toUser]]></ToUserName>
									<FromUserName><![CDATA[fromUser]]></FromUserName>
									<CreateTime>12345678</CreateTime>
									<MsgType><![CDATA[news]]></MsgType>
									<ArticleCount>2</ArticleCount>
									<Articles>
									<item>
									<Title><![CDATA[title1]]></Title> 
									<Description><![CDATA[description1]]></Description>
									<PicUrl><![CDATA[picurl]]></PicUrl>
									<Url><![CDATA[url]]></Url>
									</item>
									<item>
									<Title><![CDATA[title]]></Title>
									<Description><![CDATA[description]]></Description>
									<PicUrl><![CDATA[picurl]]></PicUrl>
									<Url><![CDATA[url]]></Url>
									</item>
									</Articles>
									</xml>';
                break;
            case 'text': //图文消息
                $textTpl = '<xml>
			                        <ToUserName><![CDATA[%s]]></ToUserName>
			                        <FromUserName><![CDATA[%s]]></FromUserName>
			                        <CreateTime>%s</CreateTime>
			                        <MsgType><![CDATA[%s]]></MsgType>
			                        <Content><![CDATA[%s]]></Content>
			                        <FuncFlag>0</FuncFlag>
			                        </xml>';
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $type, $content);
                break;
            default:
                $textTpl = '<xml>
			                        <ToUserName><![CDATA[%s]]></ToUserName>
			                        <FromUserName><![CDATA[%s]]></FromUserName>
			                        <CreateTime>%s</CreateTime>
			                        <MsgType><![CDATA[%s]]></MsgType>
			                        <Content><![CDATA[虽然你不知道你在说什么 但好像很厉害的样子]]></Content>
			                        <FuncFlag>0</FuncFlag>
			                        </xml>';
                break;
        }
        echo $resultStr;
    }
}

?>