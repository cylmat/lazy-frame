<?php declare(strict_types = 1);

namespace Core\Traits;

/**
 * Hydrate
 */
trait GetterTrait
{
    public function __get($name)
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        }
        
        throw new \InvalidArgumentException("La propriété $name n'existe pas");
        return false;
    }

    public function __set($name, $value): bool
    {
        if ($this->$name = $value) {
            return true;
        }
        return false;
    }
}
