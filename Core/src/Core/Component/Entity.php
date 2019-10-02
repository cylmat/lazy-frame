<?php declare(strict_types = 1);

namespace Core\Component;

use Core\Contract\EntityInterface;
use Core\Traits\CallTrait;
use Core\Kernel\ApplicationComponent;

class Entity extends ApplicationComponent implements EntityInterface
{
    use CallTrait;

    function count()
    {
        return count(get_object_vars($this));
    }

    /**
     * Récupere les propriétés
     */
    function gets()
    {
        return get_object_vars($this);
    }

    function __call($name, $arg)
    {
        if (preg_match('/set(.*)/', $name, $propName)) {
            $propName = strtolower($propName[1]);
            if (property_exists($this, $propName)) {
                $this->$propName = $arg[0];
                return true;
            }
            return false;
        } elseif (preg_match('/get(.*)/', $name, $propName)) {
            $propName = strtolower($propName[1]);
            if (property_exists($this, $propName)) {
                return $this->$propName;
            }
            return null;
        }
    }
}
