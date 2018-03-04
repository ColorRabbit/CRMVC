<?php
/**
 * Created by PhpStorm.
 * User: colorrabbit
 * Date: 2017/6/8
 * Time: 下午8:41
 */
use Symfony\Component\Yaml\Yaml;

class CR
{
    /**
     * @var
     */
    public static $controller;

    /**
     * @var
     */
    public static $method;

    /**
     * @var
     */
    private static $config;

    /**
     * @var
     */
    private static $parameters;

    /**
     * @var
     */
    public static $model;

    /**
     * @param $config
     *
     * @return mixed
     */
    public static function init_config($config)
    {
        self::$config = Yaml::parse(file_get_contents(CONFIG_PATH . '/config.yml'));
        return self::$config[$config];
    }

    /**
     * @param $parameters
     *
     * @return mixed
     */
    private static function init_parameters($parameters)
    {
        self::$parameters = Yaml::parse(file_get_contents(CONFIG_PATH . '/parameters.yml'));
        return self::$parameters[$parameters];
    }

    /**
     * 数据库
     */
    private static function init_db()
    {
        self::$model = PdoClient::getInterface(self::init_parameters('parameters'));
    }

    /**
     * @param $request
     */
    private static function init_controller($request)
    {
        self::$controller = empty($request->get('ct')) ? 'index' : strtolower($request->get('ct'));
    }

    /**
     * @param $request
     */
    private static function init_method($request)
    {
        self::$method = empty($request->get('mt')) ? 'index' : strtolower($request->get('mt'));
    }

    /**
     * 入口方法
     */
    public static function run()
    {
        $services = new Services();
        $workshop = new WorkShop();
        $request = $services->getRequest();
        self::init_db();

        $routerConfig = static::init_config('Router');
        if ($routerConfig['type'] == 1) {
            Router::RouterInterface($routerConfig['dir']);
            $workshop::Action(Router::getController(), Router::getMethod(), Router::getId());
        }

        if ($routerConfig['type'] == 0) {
            self::init_controller($request);
            self::init_method($request);
            $workshop::Action(self::$controller, self::$method);
        }
    }
}