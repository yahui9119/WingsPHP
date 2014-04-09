<?php
/**
 * 模板类
 * @copyright   Copyright(c) 2011
 * @author      yuansir <yuansir@live.cn/yuansir-web.com>
 * @version     1.0
 */
final class View
{
    public $view_name = null;
    public $data = array();
    public $out_put = null;

    public function init($view_name, $data = array())
    {
        $this->view_name = $view_name;
        $this->data = $data;
        $this->fetch();
    }

    /**
     * 加载模板文件
     * @access      public
     * @param       string $file
     */
    public function fetch()
    {
        $view_file = VIEW_PATH . '/' . $this->view_name . '.php';
        if (file_exists($view_file)) {
            extract($this->data);
            ob_start();
            include $view_file;
            $content = ob_get_contents();
            ob_end_clean();
            $this->out_put = $content;
        } else {
            trigger_error('加载 ' . $view_file . ' 模板不存在');
        }
    }

    /**
     * 输出模板
     * @access      public
     * @return      string
     */
    public function outPut()
    {
        echo $this->out_put;
    }
}