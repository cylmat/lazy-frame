<?php

namespace Core\Component;

use Core\Component\Application;
use Core\Contract\ApplicationComponentInterface;

class ApplicationComponent implements ApplicationComponentInterface
{
    /**
     * Container object
     * 
     * @var array
     */
    protected $container;

    public function setContainer(&$container)
    {
        $this->container = $container;
    }
}
