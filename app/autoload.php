<?php

class LazyLoad
{
    public static $filesPath = [];
    public static $ini=null;

    public static function load()
    {
        self::$ini = parse_ini_file(APP_ROOT.'app/config/config.ini', true);
        $path = APP_ROOT.self::$ini['APP']['src_path'];
        self::parse($path);
    }

    public static function parse($dir)
    {
        foreach(new DirectoryIterator($dir) as $n => $fileinfo)
        {
            if(!$fileinfo->isDot() && $fileinfo->isDir()) 
                self::parse($fileinfo->getPathname());
            elseif($fileinfo->isFile()) 
                self::$filesPath[pathinfo($fileinfo->getFilename())['filename']] = $fileinfo->getRealPath();
        }
    }
}

LazyLoad::load();
function autoload($class)
{
    include_once LazyLoad::$filesPath[$class];
}

spl_autoload_register('autoload');