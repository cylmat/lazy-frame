<?php

class Logger
{
    public static $log = '';
    static function log($msg) { self::$log .= PHP_EOL.$msg; } 
    static function assert($a, $msg) { 
        assert_options(ASSERT_ACTIVE,1);
        $a = assert($a, '---'.$msg.'---');
        if(1 != $a) 
            static::log( $a ); 
    }
}