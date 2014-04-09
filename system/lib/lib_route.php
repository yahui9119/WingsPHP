<?php
/**
 * URL处理类
 * @copyright   Copyright(c) 2011
 * @author      yuansir <yuansir@live.cn/yuansir-web.com>
 * @version     1.0
 */
final class Route
{
    public $url_query;
    public $url_type;
    public $route_url = array();
    public $_config = null;

    public function __construct()
    {
        $this->url_query = parse_url($_SERVER['REQUEST_URI']);
        $this->_config = Application::$_config['route'];
    }

    /**
     * 设置URL类型
     * @access      public
     */
    public function setUrlType($url_type = 2)
    {
        if ($url_type > 0 && $url_type < 3) {
            $this->url_type = $url_type;
        } else {
            trigger_error("指定的URL模式不存在！");
        }
    }

    /**
     * 获取数组形式的URL
     * @access      public
     */
    public function getUrlArray()
    {
        $this->makeUrl();
        return $this->route_url;
    }

    /**
     * @access      public
     */
    public function makeUrl()
    {
        switch ($this->url_type) {
            case 1:
                $this->querytToArray();
                break;
            case 2:
                $this->pathinfoToArray();
                break;
        }
    }

    /**
     * 将query形式的URL转化成数组
     * @access      public
     */
    public function querytToArray()
    {
        $arr = !empty ($this->url_query['query']) ? explode('&', $this->url_query['query']) : array();
        $array = $tmp = array();
        if (count($arr) > 0) {
            foreach ($arr as $item) {
                $tmp = explode('=', $item);
                $array[$tmp[0]] = $tmp[1];
            }
            if (isset($array['app'])) {
                $this->route_url['app'] = $array['app'];
                unset($array['app']);
            }
            if (isset($array['controller'])) {
                $this->route_url['controller'] = $array['controller'];
                unset($array['controller']);
            }
            if (isset($array['action'])) {
                $this->route_url['action'] = $array['action'];
                unset($array['action']);
            }
            if (count($array) > 0) {
                $this->route_url['params'] = $array;
            }
        } else {
            $this->route_url = array();
        }
    }

    /**
     * 将PATH_INFO的URL形式转化为数组
     * @access      public
     */
    public function pathinfoToArray()
    {
        //var_dump($this->url_query);

        $path = $this->url_query['path'];
        $query = isset($this->url_query['query']) ? $this->url_query['query'] : '';
        $rootpath = $this->_config['rootpath'];
        $rootpathStart = strpos($path, $rootpath);
        if ($rootpathStart == 0) {
            $rootpathEnd = strspn($path, $rootpath);
            $path = substr($path, $rootpathEnd);
        }
        $arr = !empty ($this->url_query['query']) ? explode('&', $this->url_query['query']) : array();
        $array = $tmp = array();

        if (count($arr) > 0) {
            foreach ($arr as $item) {
                $tmp = explode('=', $item);
                $array[$tmp[0]] = count($tmp) > 1 ? $tmp[1] : '';
            }

            if (count($array) > 0) {
                $this->route_url['params'] = $array;


            }
        }
        $MapRoute = $this->_config['MapRoute']; //获取路由配置
        if (isset($MapRoute)) {
            foreach ($MapRoute as $key => $value) {
                $RouteArray = $this->IsPath($path, $value);
                if ($RouteArray) {
                    $this->route_url = $RouteArray;
                }
            }
        } else {
            $this->route_url = array();
        }
        if (isset($this->route_url['params'])) {
            foreach ($array as $key => $value) {
                $this->route_url['params'][$key] = $value;
            }
        }
    }

    /**
     * 当前访问路径是否是此路由配置
     * @access      private
     */
    private function IsPath($path, $route)
    {
        $array = null;
        $arrRoute = explode('/', $route['url']);
        $arrPath = explode('/', $path);
        if (isset($route['defaults'])) {
            $array['controller'] = $route['defaults']['controller'];
            $array['action'] = $route['defaults']['action'];
        }
        //var_dump($arrRoute);
        //var_dump($arrPath);
        /*
        *查找controller 和action
        */
        foreach ($arrRoute as $key => $value) {
            if ($value == '{controller}') {
                if (isset($arrPath[$key]) && $arrPath[$key] != '') {
                    $array['controller'] = $arrPath[$key];
                }
                continue;
            }
            if ($value == '{action}') {
                if (isset($arrPath[$key]) && $arrPath[$key] != '') {
                    $array['action'] = $arrPath[$key];
                }
                continue;
            }
            $value = str_replace('{', '', $value);
            $value = str_replace('}', '', $value);
            $array['params'][$value] = isset($arrPath[$key]) ? $arrPath[$key] : $route['defaults'][$value];
            if (isset($route['constraints'])) //约定了路由的配置情况
            {
                foreach ($array as $key => $value) {
                    if ($key == 'controller' || $key == 'action') {
                        if (preg_match($route['constraints'][$key], $value, $resultarry)) {
                            if ($resultarry[0] != $value) {
                                return false;
                            }
                        }
                        continue;
                    }
                    if ($key = 'params') {
                        foreach ($array['params'] as $paramskey => $paramsvalue) {


                            if (preg_match($route['constraints'][$paramskey], $paramsvalue, $resultarry)) {
                                if ($resultarry[0] != $paramsvalue) { //判断参数是否匹配
                                    return false;
                                }
                            }
                        }
                    }
                }
            }
        }
        //判断是否有存在的控制器
        return $array;
    }
}


