<?php
/*
   	http://www.cnblogs.com/txw1958/
    CopyRight 2013 www.doucube.com  All Rights Reserved
*/
/**
 *    微信api
 */
class weixinapiController extends Controller
{
    function index()
    {
        //分词
        $phpanalysis = $this->load('phpanalysis', false);
        PhpAnalysis::$loadInit = false;
        $pa = new PhpAnalysis('utf-8', 'utf-8', false);
        define("TOKEN", "asdfghjwertyuiopxcvbn");
        $wechatObj = $this->load('wechatCallbackapi', false);
        if (isset($_GET['echostr'])) {
            $wechatObj->valid();
        } else {
            if ($postObj = $wechatObj->request()) {
                $fromUsername = $postObj->FromUserName;
                $toUsername = $postObj->ToUserName;
                $content = trim($postObj->Content);
                $msgtype = trim($postObj->MsgType);
                switch ($msgtype) {
                    case 'text':
                        $pa->SetSource($content);
                        $pa->StartAnalysis(false);
                        $pa->differMax = false;
                        $pa->unitWord = false;
                        $content = $pa->GetFinallyResult(' ', false);
                        break;
                    case 'image':
                        $content = $this->receiveImage($postObj);
                        break;
                    default:
                        # code...
                        break;
                }

                $wechatObj->response($fromUsername, $toUsername, $content);
            } else {
                echo "";
                exit;
            }
        }
    }

    //图片识别api
    private function receiveImage($object)
    {
        $apicallurl = urlencode("http://api2.sinaapp.com/recognize/picture/?appkey=0020120430&appsecert=fa6095e123cd28fd&reqtype=text&keyword=" . $object->PicUrl);
        $pictureJsonInfo = file_get_contents($apicallurl);
        $pictureInfo = json_decode($pictureJsonInfo, true);
        $contentStr = $pictureInfo['text']['content'];
        $resultStr = $this->transmitText($object, $contentStr);
        return $resultStr;
    }
}

?>