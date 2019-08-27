<?php declare(strict_types = 1);

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
     * Load specific with constructor parameters
     */
    /*public function appendNewSpecific($name, $constructParams): bool
    {
        if ($this->appendValid($name)) {
            return $this->get($name);
        }
    }*/

    /**
     * Load all components
     */
    public function loadCollection(): bool
    {
        $dir = new \DirectoryIterator(__DIR__);
        $isLoaded = false;
        foreach ($dir as $file) {
            if ($file->isFile()) {
                $this->_append(str_replace('.php', '', $file->getFilename()));
                $isLoaded = true;
            }
        }
        return $isLoaded;
    }

    /**
     * Get lazy-loaded components if exists
     */
    public function get($name): ?ApplicationComponent
    {
        //if exists in collection
        if (array_key_exists($name, $this->_collection)) {
            //instantiate if not instantiated
            if ($name===($this->_collection[$name])) {
                //$component = self::COMPOSANT_DIR.$name;
                $this->_create($name, $constructParams=[]); //new $component();
                //$this->_collection[$name]->setContainer($this);
            } 
            return $this->_collection[$name];

        } else { //append a composant
            if ($this->_append($name)) {
                return $this->get($name);
            }
        }
        //no component
        return null;
    }

    /**
     * Create a new component
     * Load specific with constructor parameters
     */
    private function _create($name, $constructParams=[]): bool
    {
        $component = self::COMPOSANT_DIR.$name;
        if($this->_append($name)) {
            try {
                //$c = new $component( ...$constructParams );
                $this->_collection[$name] = new $component($name, ...$constructParams); //new $component();
                $this->_collection[$name]->setContainer($this);
                return true;
            } catch(Exception $e) {
                echo "Impossible de créer $component\n";
                return null;
            }
        }
    }

    /** 
     * Varifie si un component exists dans le repertoire
     * Si oui ajoute le composant à la liste
     */
    private function _append($name): bool
    {
        $component = self::COMPOSANT_DIR.$name;
        if (class_exists($component)) {
            //not exists yet
            if (!isset($this->_collection[$name])) {
                $this->_collection[$name] = $name;
            }
            return true;
        } else {
            throw new \InvalidArgumentException("Composant $name non défini");
            return false;
        }
    }
}
