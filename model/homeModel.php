<?php
/**
 *
 * @copyright   Copyright(c) 2011
 * @author      yuansir <yuansir@live.cn/yuansir-web.com>
 * @version     1.0
 */
class homeModel extends Model
{
    function test()
    {
        echo "<h1>this is test hometest<h1/>";
    }

    function testResult()
    {
        $this->db->show_databases();
    }
}


