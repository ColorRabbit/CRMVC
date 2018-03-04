<?php
/**
 * Created by PhpStorm.
 * User: colorrabbit
 * Date: 2017/6/8
 * Time: 下午10:48
 */
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class Services
{
    public function getRequest()
    {
        return Request::createFromGlobals();
    }

    public function getSession()
    {
        $session = new Session();
        $session->start();

        return $session;
    }

}
