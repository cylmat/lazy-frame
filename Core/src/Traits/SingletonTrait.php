<?php

namespace Core\Traits;

/**
 * Singleton
 * 
 * Singleton pattern
 */
trait SingletonTrait
{
    /**
     * Instance of itself
     * 
     * @var self
     */
    private static $_instance=null;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    /**
     * Get instance
     */
    static function getInstance()
    {
        if (self::$_instance===null) {
            self::$_instance = new self;
        }
        return self::$_instance;
    }
}
