<?php
/**
 * 测试控制器
 * @copyright   Copyright(c) 2011
 * @author      yuansir <yuansir@live.cn/yuansir-web.com>
 * @version     1.0
 */
class testController extends Controller
{


    public function index()
    {
        echo "test";
    }

    public function testDb()
    {
        $modTest = $this->model('test');
        //示例化test模型
        $databases = $modTest->findall('test'); //调用test模型中
        var_dump($databases);
        //var_dump($databases);
        //var_dump($modTest->insert('test','username',"'testtest'"));
    }
} 
