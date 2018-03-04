<?php

/**
 * Created by PhpStorm.
 * User: colorrabbit
 * Date: 2017/6/21
 * Time: 上午11:45
 */
class Router
{
    private static $router;

    private static $dir;

    private static $usual = array(
        'controller' => 'index',
        'method' => 'index',
        'parameter' => null,
    );

    private function __construct($dir)
    {
        self::$dir = $dir;
    }

    public static function RouterInterface($dir = '')
    {
        if (!self::$router) {
            self::$router = new self($dir);
        }

        Router::main();
    }

    private static function main()
    {
        HandleError::handleError();
        self::rewriteUrl();
    }

    private static function rewriteUrl()
    {
        // $filePath = str_replace($_SERVER['DOCUMENT_ROOT'] . self::PROJECT_DIR, '', __FILE__);
        $mcUri = trim(str_replace('index.php', '', str_replace(self::$dir, '', $_SERVER['REQUEST_URI'])), '/');

        $arrParam = explode('?', $mcUri);
        $arrRouter = explode('/', $arrParam[0]);

        $arrRouterCount = count($arrRouter);
        // dump($arrRouterCount);
        if ($arrRouterCount == 1 && !empty($arrRouter[0])) {
            static::$usual['controller'] = $arrRouter[0];
        } elseif ($arrRouterCount == 2) {
            static::$usual['controller'] = $arrRouter[0];
            static::$usual['method'] = $arrRouter[1];
        } elseif ($arrRouterCount == 3) {
            static::$usual['controller'] = $arrRouter[0];
            static::$usual['method'] = $arrRouter[1];
            static::$usual['parameter'] = $arrRouter[2];
        } else {
            throw new \Exception('ARE YOU KIDDING ME!!!');
        }

        // if (!empty($arrParam[1])) {
        //     $this->usual['parameters'] .= $arrParam[1];
        // }
    }

    public static function getController()
    {
        return static::$usual['controller'];
    }

    public static function getMethod()
    {
        return static::$usual['method'];
    }

    public static function getId()
    {
        return static::$usual['parameter'];
    }

}
