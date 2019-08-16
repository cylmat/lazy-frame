<?php

namespace Core\Component;

/**
 * Autoload
 */
final class Autoload
{
    /**
     * Array
     */
    private static $paths_dir=[];

    public function __construct(string $path_dir = null)
    {
        if(!is_null($path_dir))
            $this->addPath($path_dir);
        $this->register();
    }

    public function addPath(string $path_dir)
    {
        self::$paths_dir[] = preg_replace('/\/$/','',$path_dir);
        $this->register();
    }

    /**
     * Load
     * Check if src/NAMEOFCLASS.php exists 
     * Check if FIRST/src/NAMEOFCLASS.php exists
     */
    public function load(string $class)
    {
        foreach(self::$paths_dir as $path)
        {
            $src_before = $path . '/src/'.$class.'.php';
            if(file_exists( $src_before )) include_once($src_before);

            //Core files (/Core/src/...)
            $src_core = $path . '/' . preg_replace('/\w*(\/|\\\)/','src/',$class,1).'.php';
            if(file_exists( $src_core )) include_once($src_core);
        }
    }

    private function register()
    {
        spl_autoload_register([$this, 'load']);
    }
}