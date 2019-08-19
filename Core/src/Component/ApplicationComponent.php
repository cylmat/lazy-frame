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

    function getComponent(string $name)
    {
        if(isset($this->application->components[$name]))
            return $this->application->components[$name];
        return false;
    }
}