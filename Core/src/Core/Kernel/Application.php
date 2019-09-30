<?php declare(strict_types = 1);

namespace Core\Kernel;

if (!defined('APP_ROOT')) {
    die("Application non définie");
}

use Core\Contract\ApplicationComponentInterface;
use Core\Traits\SingletonTrait;
use Core\Tool\Config;
use Core\Kernel\Container;

class Application
{
    use SingletonTrait;

    /**
     * Internal config
     */
    protected static $coreConfig = [];

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
        $this->container = new Container();
        $this->container->load('Database', [new \PDO('mysql:host=localhost;dbname=frame','root','root')]);
        $this->container->loadCollection();

    }

    /**
     * RUNNING Kernel Application
     */
    private function _runningKernelApplication()
    {
        $router = $this->container->get('Router');
        $httpResponse = $this->container->get('Kernel')->getResponse(
            $router->getModule(),
            $router->getController(), 
            $router->getAction()
        );
        $httpResponse->send();
    }
}
