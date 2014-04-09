<?php
/**
 *
 * @copyright   Copyright(c) 2011
 * @author      yuansir <yuansir@live.cn/yuansir-web.com>
 * @version     1.0
 */
class homeController extends Controller
{

    public function test($value)
    {
        # code...
        var_dump($value);
        echo('<h1>Action:test<h1/>');
        var_dump(PUBLICPATH);
    }

    public function index()
    {
        //$test['test']='test';

        //$this->Json($test);
        $this->View('home/index');
        //echo '这里是主页 home/index';
        /*
        $object = $this->load('download',FALSE);
        var_dump($object);
        //exit();

        $object->downloadFile('error/2011-12-28_SQL.txt');//服务器文件名,包括路径
        $object->filename = "2011-12-28_SQL.txt";//下载另存为的文件名
        $object->download();
        */
    }
}

