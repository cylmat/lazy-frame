<?php

trait SingletonTrait
{
    private static $instance=null;
    private function __construct() {}
    private function __clone() {}

    static function getInstance()
    {
        if(self::$instance===null) self::$instance = new self;
        return self::$instance;
    }
}