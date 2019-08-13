<?php

class PersoEntity
{
    private $id;
    private $name;
    private $life;
    private $class;
    private $level;
    private $force;

    function __call($name, $arg)
    {
        if(preg_match('/set(.*)/',$name, $propName))
        {
            $propName = strtolower($propName[1]);
            if(property_exists($this,$propName))
                $this->$propName = $arg[0];
        }
        elseif(preg_match('/get(.*)/',$name, $propName))
        {
            $propName = strtolower($propName[1]);
            if(property_exists($this,$propName))
                return $this->$propName;
        }
    }
}
