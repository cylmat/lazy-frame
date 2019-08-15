<?php

abstract class ApplicationComponent implements ApplicationComponentInterface
{
    private $application;

    function inject(Application $app)
    {
        $this->application = $app;
    }
}