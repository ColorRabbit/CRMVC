<?php

class PdoClient
{
    private static $dbInterface;

    private function __construct()
    {
    }

    private function __clone()
    {
        // TODO: Implement __clone() method.
    }

    public static function getInterface($parameters)
    {
        if(!self::$dbInterface){
            self::$dbInterface = new MysqliDb($parameters);
        }

        return self::$dbInterface;
    }
}
