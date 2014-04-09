<?php
/**
 * 系统配置文件
 * @copyright   Copyright(c) 2011
 * @author      yuansir <yuansir@live.cn/yuansir-web.com>
 * @version     1.0
 */

/*数据库配置*/
$CONFIG['system']['db'] = array(
    'db_host' => 'sqld.duapp.com:4050',
    'db_user' => 'pWUHLFFgl7GaqxR0fXSBGBgT',
    'db_password' => 'FDpSMuA72WadYLw6Y56yFvy38XMtGZuW',
    'db_database' => 'hipxewwZaeLoyAJcZJfJ',
    'db_table_prefix' => 'app_',
    'db_charset' => 'urf8',
    'db_conn' => '', //数据库连接标识; pconn 为长久链接，默认为即时链接


);

/*自定义类库配置*/
$CONFIG['system']['lib'] = array(
    'prefix' => 'my' //自定义类库的文件前缀
);
/*应用相对于站点根目录的路径*/
$CONFIG['rootpath'] = '';

$CONFIG['system']['route'] = array(
    'rootpath' => '/app', /*应用相对于站点根目录的路径 格式：‘/’开头 不要以‘/’结尾  根目录写‘/’*/
    'url_type' => 2, /*定义URL的形式 1 为普通模式    index.php?c=controller&a=action&id=2
                                                         *              2 为PATHINFO   index.php/controller/action/id/2
                                                         */
    'default_controller' => 'home', //系统默认控制器 什么都没配置下使用
    'default_action' => 'index', //系统默认控制器

    'MapRoute' => array
    (
        array
        (
            'name' => 'default',
            'url' => '{controller}/{action}/{id}',
            'defaults' => array
            (
                'controller' => 'home',
                'action' => 'index',
                'id' => '0' //表示示路由过程中类使用的可选参数。
            ),
            'constraints' => array
            (
                'controller' => '/^.*/',
                'action' => '/^.*/',
                'id' => '/^\d*/'
            )
        ),
    )
);

/*缓存配置*/
$CONFIG['system']['cache'] = array(
    'cache_dir' => 'cache', //缓存路径，相对于根目录
    'cache_prefix' => 'cache_', //缓存文件名前缀
    'cache_time' => 1800, //缓存时间默认1800秒
    'cache_mode' => 2, //mode 1 为serialize ，mode 2为保存为可执行文件
);






