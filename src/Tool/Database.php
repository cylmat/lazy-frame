<?php

class Database
{
    private static $instance=null;
    private $db=null;

    private function __construct() 
    {

    }

    static function getInstance()
    {
        if(null === self::$instance)
            self::$instance = new self;
        return self::$instance;
    }

    private function __clone() {}

    /**
     * $manager: PDO, mysqli, etc...
     */
    function setDataAccess( $dataAccess )
    {
        if($this->db = $dataAccess) 
            return true;
    }

    function __call($name, $arg=[])
    {
        if(!isset($arg[0])) $arg[0] = '';
        if(method_exists($this->db,$name))
            return $this->db->$name(...$arg);
        return false;
    }
}