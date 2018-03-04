<?php

/**
 * Created by PhpStorm.
 * User: colorrabbit
 * Date: 2017/7/3
 * Time: 上午11:01
 */

class HandleError
{
    public function __construct()
    {
    }

    public static function handleError()
    {
        header('Content-type: text/html;charset=UTF-8');
        // ini_set('display_errors', 0);    //关闭错误输出到页面
        error_reporting(-1);
        //报告所有 PHP 错误
        register_shutdown_function('HandleError::shutdownHandler');
        set_error_handler('HandleError::errorHandler');
        set_exception_handler('HandleError::exceptionHandler');
    }

    /**
     * 自定义致命错误处理
     */
    public static function shutdownHandler()
    {
        if(is_null($e = error_get_last()) === false) {
            $error = new myError($e);
            self::handler($error);
        }
    }

    /**
     * 自定义错误处理
     *
     * @param $code
     * @param $message
     * @param $file
     * @param $line
     */
    public static function errorHandler($code, $message, $file, $line)
    {
        $error = new MyError([
            'date' => date('Y-m-d H:i:s'),
            'type' => $code,
            'message' => $message,
            'file' => $file,
            'line' => $line,
            'isError' => true
        ]);
        self::handler($error);
    }

    /**
     * 自定义异常处理
     *
     * @param $exception
     */
    public static function exceptionHandler($exception)
    {
        $error = new MyError([
            'date' => date('Y-m-d H:i:s'),
            'type' => $exception->getCode(),
            'message' => $exception->getMessage(),
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
            'exception' => $exception,
            'isException' => true
        ]);
        self::handler($error);
    }

    private static function handler($error)
    {
        //在这里对错误进行统一处理
        dump($error);
        // $logFile = 'D:/phpStudy/WWW/vendor/logs/error.log';
        // file_put_contents($logFile, serialize($error).PHP_EOL, FILE_APPEND|LOCK_EX);
    }
}

