<?php

namespace Core\Abstracts;

use Core\Contract\ApplicationInterface;
use Core\Contract\ApplicationComponentInterface;

abstract class AbstractAppComponent implements ApplicationComponentInterface
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