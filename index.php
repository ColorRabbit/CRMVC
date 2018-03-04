<?php
/**
 * Created by PhpStorm.
 * User: colorrabbit
 * Date: 2017/6/8
 * Time: 下午8:38
 */
header('Content-Type:text/html; charset=utf-8');

define('PATH', str_replace('\\', '/', __DIR__));
define('APP_PATH', PATH . '/application');
define('CONFIG_PATH', PATH . '/config');
define('FRAMEWORK_PATH', PATH . '/framework');

require_once __DIR__ . '/vendor/autoload.php';
// require_once FRAMEWORK_PATH . '/CR.php';

CR::run();
