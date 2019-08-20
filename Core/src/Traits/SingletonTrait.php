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
        if (self::$instance===null) {
            self::$instance = new self;
        }
        return self::$instance;
    }
}
