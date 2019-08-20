<?php

namespace Core\Tool;

class Config
{
    private static $config;

    private function __construct()
    {
    }
    private function __clone()
    {
    }

    public static function get(string $configPath): Config
    {
        if(!file_exists($configPath)) {
            throw new \InvalidArgumentException("File $configPath doesn't exists");
            return false;
        }

        self::$config = parse_ini_file($configPath, true);
        return new self;
    }

    public function __get(string $name)
    {
        $name = strtoupper($name);
        if(isset(self::$config[$name])) { 
            return (object)self::$config[$name];
        }

        throw new \InvalidArgumentException("Argument $name doesn't exists"); 
        return false;
    }
}
