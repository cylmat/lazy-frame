<?php

namespace Core\Traits;

/**
 * Hydrate
 */
trait CallTrait
{
    public function __call($name, $arg=[])
    {
        if(!isset($arg[0])) $arg[0] = '';
            if(method_exists($this->db,$name))
                return $this->db->$name(...$arg);
        return false;
    }
}