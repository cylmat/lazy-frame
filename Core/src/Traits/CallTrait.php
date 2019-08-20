<?php

namespace Core\Traits;

/**
 * Hydrate
 */
trait CallTrait
{
    public function __call($name, $arg=[])
    {
        if (method_exists($this, $name)) {
            return $this->$name(...$arg);
        }
        
        throw new \InvalidArgumentException("La méthode $name n'existe pas");
        return false;
    }
}
