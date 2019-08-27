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
     * Composants directory
     */
    const DIRECTORY = __DIR__;

    /**
     * Collection of ApplicationComponent;
     * 
     * @var array
     */
    private $_collection=[];

    /**
     * Demande le chargement d'un élément
     */
    public function load(string $name, array $constructorParams=[]): bool
    {
        return $this->_append($name, $constructorParams);
    }

    /**
     * Load all components with no constructors
     */
    public function loadCollection(): bool
    {
        $isLoaded = false;
        $dir = new \DirectoryIterator(self::DIRECTORY);
        foreach ($dir as $file) {
            if ($file->isFile()) {
                $this->_append(str_replace('.php', '', $file->getFilename()), []);
                $isLoaded = true;
            }
        }
        return $isLoaded;
    }

    /**
     * Get lazy-loaded components if exists
     */
    public function get(string $name): ?ApplicationComponent
    {
        //if exists in collection
        if (array_key_exists($name, $this->_collection)) {
            //if not instantiated
            if (!is_object($this->_collection[$name])) {
                $this->_create($name); 
            } 
            //return object
            return $this->_collection[$name];
        } else {
            throw new \InvalidArgumentException("Composant $name impossible à récupérer");
        }
        //no component
        return null;
    }

    /**
     * Create a new component
     * Load specific with constructor parameters
     */
    private function _create(string $name): bool
    {
        $component = self::COMPOSANT_DIR.$name;
        if($this->_append($name)) {
            try {
                $this->_collection[$name] = new $component(...$this->_collection[$name]); 
                $this->_collection[$name]->setContainer($this);
                return true;
            } catch(Exception $e) {
                echo "Impossible de créer $component\n";
                return null;
            }
        }
    }

    /** 
     * Vérifie si un component est valide (exists dans le repertoire)
     * Si oui ajoute le composant à la liste
     */
    private function _append(string $name, array $constructorParams=[]): bool
    {
        $component = self::COMPOSANT_DIR.$name;
        if (class_exists($component)) {
            //not exists yet
            if (!isset($this->_collection[$name])) {
                $this->_collection[$name] = $constructorParams;
            }
            return true;
        } else {
            throw new \InvalidArgumentException("Composant $name non existant");
            return false;
        }
    }
}
