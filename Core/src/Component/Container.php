<?php

namespace Core\Component;

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
    private $_collection=[];

    /**
     * Load all components
     */
    public function loadCollection(): bool
    {
        $dir = new \DirectoryIterator(__DIR__);
        $loaded = false;
        foreach ($dir as $file) {
            if ($file->isFile()) {
                $this->append(str_replace('.php','',$file->getFilename()));
                $loaded = true;
            }
        }
        return $loaded;
    }

    /**
     * Get lazy-loaded components
     */
    public function get($name): ?ApplicationComponent
    {
        //exists in collection
        if (array_key_exists($name, $this->_collection)) {
            //not instantiated
            if ($name===($this->_collection[$name])) {
                $component = self::COMPOSANT_DIR.$name;
                $this->_collection[$name] = new $component();
                $this->_collection[$name]->setContainer($this);
            } 
            return $this->_collection[$name];

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
    public function append($name): bool
    {
        $component = self::COMPOSANT_DIR.$name;
        if (class_exists($component)) {
            //not exists yet
            if(!isset($this->_collection[$name])) {
                $this->_collection[$name] = $name;
                return true;
            }
        } else {
            throw new \InvalidArgumentException("Composant $name non défini");
            return false;
        }
    }
}