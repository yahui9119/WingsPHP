<?php
/**
 * 核心控制器类
 * @copyright   Copyright(c) 2011
 * @author      yuansir <yuansir@live.cn/yuansir-web.com>
 * @version     1.0
 */
class Model
{
    protected $db = null;
    protected $model = null; //单个模型的数据格式定义
    final public function __construct()
    {
        //header('Content-type:text/html;chartset=utf-8');
        $this->db = $this->load('mysql');
        $config_db = $this->config('db');
        $this->db->init(
            $config_db['db_host'],
            $config_db['db_user'],
            $config_db['db_password'],
            $config_db['db_database'],
            $config_db['db_conn'],
            $config_db['db_charset']
        ); //初始话数据库类
    }

    /**
     * 根据根据model的定义获取数据
     * @access      final   public
     * @param       string $method    表名
     */
    final public function requestModel($method = 'GET')
    {
        $model = array();
        foreach ($this->model as $key => $value) {
            $getvalue = $method == 'GET' ? (isset($_GET[$key]) ? $_GET[$key] : $value['defaultvalue']) : (isset($_POST[$key]) ? $_POST[$key] : $value['defaultvalue']);
            switch ($value['type']) {
                case 'int':
                    $getvalue = intval($getvalue);
                    break;
                case 'varchar':
                    $getvalue = "$getvalue";
                    break;
                default:
                    # code...
                    break;
            }
            $model[$key] = $getvalue;
        }
        return $model;
    }

    //简化查询select
    public function findall($table)
    {
        $tablename = $this->table($table);
        $this->db->findall($tablename);
        return $this->db->fetch_array();
    }

    //简化查询select
    public function select($table, $columnName = "*", $condition = '', $debug = '')
    {
        $tablename = $this->table($table);
        $this->db->select($tablename, $columnName, $condition, $debug);
        return $this->db->fetch_array();
    }

    //简化删除del
    public function delete($table, $condition)
    {
        $tablename = $this->table($table);
        return $this->db->delete($tablename, $condition);
    }

    //简化插入insert
    public function insert($table, $columnName, $value)
    {
        $tablename = $this->table($table);
        return $this->db->insert($tablename, $columnName, $value);
    }

    //简化修改update
    public function update($table, $mod_content, $condition)
    {
        $tablename = $this->table($table);
        return $this->db->update($tablename, $mod_content, $value);
    }

    //添加一个模型
    /*
    public function insert($model=array())
    {

            $modelname=str_replace('Model','',get_class($this));
            $tablename=$this->table($modelname);
            if(count($model)<=0){

                return false;
            }
            $columnName=$value='';
            foreach ($model as $key => $value) {
                   $columnName=($key+',' )
            }

    }
    */
    /**
     * 根据表前缀获取表名
     * @access      final   protected
     * @param       string $table_name    表名
     */
    final protected function table($table_name)
    {
        $config_db = $this->config('db');
        return $config_db['db_table_prefix'] . $table_name;
    }

    /**
     * 加载类库
     * @param string $lib   类库名称
     * @param Bool $my     如果FALSE默认加载系统自动加载的类库，如果为TRUE则加载自定义类库
     * @return type
     */
    final protected function load($lib, $my = FALSE)
    {
        if (empty($lib)) {
            trigger_error('加载类库名不能为空');
        } elseif ($my === FALSE) {
            return Application::$_lib[$lib];
        } elseif ($my === TRUE) {
            return Application::newLib($lib);
        }
    }

    /**
     * 加载系统配置,默认为系统配置 $CONFIG['system'][$config]
     * @access      final   protected
     * @param       string $config 配置名
     */
    final   protected function config($config = '')
    {
        return Application::$_config[$config];
    }
}


