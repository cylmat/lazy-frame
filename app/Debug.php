<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

Debug::init();
        
/**
 * Debug
 */
class Debug
{
    private static $logger;
    const file_path = __DIR__.'/../var/debug.log';
    
    public static function init()
    {
        self::$logger = new Logger('my_log');
        if(file_exists(self::file_path))
            unlink(self::file_path);
        self::$logger->pushHandler( new StreamHandler(self::file_path) );
    }
            
    public static function info($txt)
    {
        self::$logger->info($txt);
    }
    
    public static function debug($txt)
    {
        self::$logger->debug($txt);
    }
    
    public static function display()
    {
        $a = file_get_contents(self::file_path);
        $a = explode("\n", $a);
        var_dump($a);
    } 
}
