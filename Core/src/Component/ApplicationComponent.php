<?php

namespace Core\Component;

use Core\Component\Application;
use Core\Contract\ApplicationComponentInterface;

class ApplicationComponent implements ApplicationComponentInterface
{
    /*public $application;

    function inject(Application &$app)
    {
        $this->application = $app;
    }

    function __get(string $componentName): ApplicationComponent
    {
        return $this->getComponent(ucfirst($componentName));
    }

    protected function getComponent(string $name): ApplicationComponent
    {
        if (isset($this->application->components[$name])) {
            $component = $this->application->components[$name];
            if (is_string($name)) {
                $component = '\\Core\\Component\\'.$name;
                return new $component();
            } else {
                return $this->application->components[$name];
            }
        }
        
        throw new \InvalidArgumentException("Composant $name non défini");
        return false;
    }*/
}
