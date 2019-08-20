<?php

namespace Core\Component;

use Core\Contract\ApplicationInterface;
use Core\Contract\ApplicationComponentInterface;

class ApplicationComponent implements ApplicationComponentInterface
{
    public $application;

    function inject(ApplicationInterface $app)
    {
        $this->application = $app;
    }

    function __get(string $componentName): ApplicationComponent
    {
        return $this->getComponent(ucfirst($componentName));
    }

    protected function getComponent(string $name):ApplicationComponent
    {
        if(isset($this->application->components[$name]))
            return $this->application->components[$name];
        
        throw new \InvalidArgumentException("Composant $name non défini");
        return false;
    }
}