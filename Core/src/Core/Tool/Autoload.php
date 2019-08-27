<?php declare(strict_types = 1);

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

    public static function addPath(string $pathDir)
    {
        self::$_pathsDir[] = preg_replace('/\/$/', '', $pathDir);
        self::_register();
    }

    /**
     * Load
     * Check if src/NAMEOFCLASS.php exists 
     * Check if FIRST/src/NAMEOFCLASS.php exists
     */
    public static function load(string $class)
    {
        foreach (self::$_pathsDir as $path) {
            $src_before = $path . DIR_SEP.'src'.DIR_SEP.$class.'.php';

            $src_before = str_replace('\\', '/', $src_before);
            if (file_exists($src_before)) {
                include_once $src_before;
            }
        }
    }

    private static function _register()
    {
        spl_autoload_register(['Core\Tool\Autoload', 'load']);
    }
}
