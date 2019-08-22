<?php declare(strict_types = 1);

namespace Core\Component;

use Core\Component\ApplicationComponent;
use Core\Contract\DatabaseInterface;
use Core\Traits\SingletonTrait;

class Database extends ApplicationComponent
{
    use SingletonTrait;

    private $_db=null;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    /**
     * $manager: PDO, mysqli, etc...
     */
    function setDataAccess( $dataAccess )
    {
        if ($this->_db = $dataAccess) {
            return true;
        }
    }

    function __call($name, $arg=[])
    {
        if (!isset($arg[0])) {
            $arg[0] = '';
        }
        if (method_exists($this->_db, $name)) {
            return $this->_db->$name(...$arg);
        }
        return false;
    }
}
