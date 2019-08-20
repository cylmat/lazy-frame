<?php

namespace Core\Component;

if(!defined('APP_ROOT')) die("Application non définie");

use Core\Contract\ApplicationInterface;
use Core\Contract\ApplicationComponentInterface;
use Core\Traits\SingletonTrait;
use Core\Component\ApplicationComponent;
use Core\Tool\Config;

class Application extends ApplicationComponent implements ApplicationInterface
{
    use SingletonTrait;

    /**
     * Internal config
     */
    protected static $coreConfig = [

    ];

    /**
     * 
     */
    public $components=[];

    /**
     * @var Config
     * 
     * public configuration
     */
    public static $config;

    private function __construct()
    {
        $this->loadComponents();
        $this->runningKernelApplication();
    }

    /**
     * 
     */
    public static function run( Config $config )
    {
        self::$config = $config;
        self::getInstance();
    }

    /**
     * Load components globally in Lazyloading
     */
    private function loadComponents()
    {
        $this->append(new \Core\Component\HttpRequest(), 'HttpRequest');
        $this->append(new \Core\Component\HttpResponse(), 'HttpResponse');
        $this->append(new \Core\Component\Kernel(), 'Kernel');
        $this->append(new \Core\Component\Router(), 'Router');
        $this->append(new \Core\Component\Template(), 'Template');
        new \Core\Component\Controller();

        $database = \Core\Component\Database::getInstance();
        $database->setDataAccess( new \PDO('mysql:host=localhost;dbname=game','root','root') );
        $this->append($database, 'Database');

        $this->inject($this);
    }

    /**
     * RUNNING Kernel Application
     */
    private function runningKernelApplication()
    {
        $httpResponse = $this->kernel->getResponse(
            $this->router->getModule(),
            $this->router->getController(), 
            $this->router->getAction()
        );
        $httpResponse->send();
    }

    /**
     *  TODO: collection
     */
    private function append(ApplicationComponentInterface $component, $name)
    {
        $component->inject($this);
        $this->components[$name] = $component;
    }
}