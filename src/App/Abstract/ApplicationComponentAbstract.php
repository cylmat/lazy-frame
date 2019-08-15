<?php

abstract class ApplicationComponentAbstract implements ApplicationComponentInterface
{
    private $application;

    function inject(Application $app)
    {
        $this->application = $app;
    }
}