<?php
/**
 * 测试模型
 * @copyright   Copyright(c) 2011
 * @author      yuansir <yuansir@live.cn/yuansir-web.com>
 * @version     1.0
 */
class testModel extends Model
{
    public $model = array('id' => array('type' => 'int', 'length' => 10, 'defaultvalue' => 0, 'primarykey' => true, 'autoincrement' => true),
        'username' => array('type' => 'varchar', 'length' => 50, 'defaultvalue' => ''),
    );

    function testDatabases()
    {
        $this->db->select($this->table('test'));
        var_dump($this->db->fetch_row());
        echo '<br/>';
        //var_dump($this->db->RequestModel());
    }
}