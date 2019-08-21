<?php

namespace Core\Component;

if (!defined('APP_ROOT')) {
    die("Application non définie");
}

use Core\Contract\ApplicationInterface;
use Core\Contract\ApplicationComponentInterface;
use Core\Traits\SingletonTrait;
//use Core\Component\ApplicationComponent;
use Core\Tool\Config;

class Application 
{
    use SingletonTrait;

    /**
     * Internal config
     */
    protected static $coreConfig = [

    ];

    /**
     * Application components
     * 
     * @var array
     */
    //public $components=[];

    /**
     * Public configuration
     * 
     * @var Config
     */
    public static $config;

    private function __construct()
    {
        $this->_loadComponents();
        $this->_runningKernelApplication();
    }

    /**
     * Launch application
     */
    public static function run( Config $config )
    {
        self::$config = $config;
        self::getInstance();
    }

    /**
     * Load components globally in Lazyloading
     */
    private function _loadComponents()
    {
        $this->_append('HttpRequest');
        $this->_append('HttpResponse');
        $this->_append('Kernel');
        $this->_append('Router');
        $this->_append('Template');
        $this->_append('Controller');
        $this->_append('Database');

        //$this->_append(new \Core\Component\HttpRequest(), 'HttpRequest');
       /* $this->_append(new \Core\Component\HttpResponse(), 'HttpResponse');
        $this->_append(new \Core\Component\Kernel(), 'Kernel');
        $this->_append(new \Core\Component\Router(), 'Router');
        $this->_append(new \Core\Component\Template(), 'Template');
        new \Core\Component\Controller();

        $database = \Core\Component\Database::getInstance();
        $database->setDataAccess(new \PDO('mysql:host=localhost', 'root', 'root'));
        $this->_append($database, 'Database');*/
    }

    /**
     * RUNNING Kernel Application
     */
    private function _runningKernelApplication()
    {
        $httpResponse = $this->kernel->getResponse(
            $this->router->getModule(),
            $this->router->getController(), 
            $this->router->getAction()
        );
        $httpResponse->send();
    }

    /**
     *  TODO: lazy
     */
    /*private function _appendText(string $componentName)
    {
        $this->components[$componentName] = true;
    }*/

    /*private function _append(ApplicationComponentInterface $component, $name)
    {
        $component->inject($this);
        $this->components[$name] = $component;
        $this->$name = $component;
    }*/

    private function append($name)
    {

    }
}
