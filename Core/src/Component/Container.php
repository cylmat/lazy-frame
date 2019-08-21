<?php

namespace Core\Tool;

/**
 * Class Container
 * 
 * Contient les diférents Components de l'application
 */
class Container 
{
    const COMPOSANT_DIR = '\\Core\\Component\\';

    /**
     * Collection of ApplicationComponent;
     * 
     * @var array
     */
    private $collection;

    /**
     * Get lazy-loaded components
     */
    function get($name): ?ApplicationComponent
    {
        //exists in collection
        if (array_key_exists($name, $this->collection)) {
            //not instantiated
            if ($name===($this->collection[$name])) {
                $component = self::COMPOSANT_DIR.$name;
                $this->collection[$name] = new $component();
            } 
            return $this->collection[$name];

        } else { //append a valid composant
            if($this->append($name)) {
                return $this->get($name);
            }
        }
        //no component
        return null;
    }

    /**
     * Ajoute un nouveau composant valide
     */
    function append($name): bool
    {
        $component = self::COMPOSANT_DIR.$name;
        if (class_exists($component)) {
            //not exists yet
            if(!isset($this->collection[$name])) {
                $this->collection[$name] = $name;
                return true;
            }
        } else {
            throw new \InvalidArgumentException("Composant $name non défini");
            return false;
        }
    }

    protected function getComponent(string $name): ApplicationComponent
    {
        if (isset($this->application->components[$name])) {
            $component = $this->application->components[$name];
            if (is_string($name)) {
                $component = '\\Core\\Component\\'.$name;
                return new $component();
        } else {
            throw new \InvalidArgumentException("Composant $name non défini");
            return false;
        }

        return $this->application->components[$name];
    }
}