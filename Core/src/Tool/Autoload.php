<?php

namespace Core\Tool;

/**
 * Autoload
 */
final class Autoload
{
    /**
     * Array
     */
    private static $_pathsDir=[];

    public function __construct(string $pathDir = null)
    {
        if (!is_null($pathDir)) {
            $this->addPath($pathDir);
        }
        $this->_register();
    }

    public function addPath(string $pathDir)
    {
        self::$_pathsDir[] = preg_replace('/\/$/', '', $pathDir);
        $this->_register();
    }

    /**
     * Load
     * Check if src/NAMEOFCLASS.php exists 
     * Check if FIRST/src/NAMEOFCLASS.php exists
     */
    public function load(string $class)
    {
        foreach (self::$_pathsDir as $path) {
            $src_before = $path . '/src/'.$class.'.php';
            if (file_exists($src_before)) {
                include_once $src_before;
            }

            //Core files (/Core/src/...)
            $src_core = $path . '/' . preg_replace('/\w*(\/|\\\)/', 'src/', $class, 1).'.php';
            if (file_exists($src_core)) {
                include_once $src_core;
            }
        }
    }

    private function _register()
    {
        spl_autoload_register([$this, 'load']);
    }
}
