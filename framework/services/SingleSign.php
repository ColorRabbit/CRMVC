<?php
/**
 * Created by PhpStorm.
 * User: Damon
 * Date: 6/7/2017
 * Time: 5:18 PM
 */
use ColorGallery\Curl;

class SingleSign
{
    const URL = 'https://api.uptimerobot.com/';

    private static $interface;

    private static $function;

    private static $oldApi = FALSE;

    protected $accessFunction = array(
        'getAccountDetails',
        'getMonitors',
        'newMonitor',
        'editMonitor',
        'deleteMonitor',
        'resetMonitor',
        'getAlertContacts',
        'newAlertContact',
        'deleteAlertContact',
    );

    protected $accessNewFunction = array(
        'editAlertContact',
        'getMWindows',
        'newMWindow',
        'editMWindow',
        'deleteMWindow',
    );

    private function __construct($function)
    {
        $functionArr = explode('/', $function);

        if (count($functionArr) === 1) {
            static::$oldApi = true;
            if (in_array($functionArr[0], $this->accessFunction)) {
                static::$function = $function;
                set_error_handler('The APIv1 will be retired by 1 Oct 2017 and please switch to APIv2 before that date.', ASSERT_WARNING);
            } else {
                throw new \Exception('NONE API ' . $function);
            }
        }

        if ($functionArr[0] == 'v2') {
            if (in_array($functionArr[1], $this->accessFunction) || in_array($functionArr[1], $this->accessNewFunction)) {
                static::$function = $function;
            } else {
                throw new \Exception('NONE API ' . $function);
            }
        }

    }

    public static function getInterface($class, $param, $type = 'GET')
    {
        if (!(self::$interface instanceof self)) {
            self::$interface = new self($class);
        }

        return self::curl($param, $type);
    }

    private static function curl($param = array(), $type)
    {
        // require_once FRAMEWORK_PATH . '/lib/curl.php';
        $curl = new Curl();

        $curl->setUrl(self::URL);
        $curl->setFunction(static::$function);
        $curl->setParameter($param);
        $curl->setCurlType($type);

        return $curl->curl();
    }

    private function __clone()
    {
        // TODO: Implement __clone() method.
    }
}




