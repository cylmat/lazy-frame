<?php

abstract class ApplicationComponent implements ApplicationComponentInterface
{
    public $application;

    function inject(Application $app)
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