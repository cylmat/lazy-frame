<?php

class Application 
{
    use SingletonTrait;

    /**
     * 
     */
    public $components=[];

    public static $config;

    private function __construct()
    {
        $this->loadComponents();
        $this->runningApplication();
    }

    /**
     * 
     */
    static function run()
    {
        self::getInstance();
    }

    /**
     * 
     */
    public function getComponent(string $name)
    {
        if(isset($this->components[$name]))
            return $this->components[$name];
        return false;
    }

    private function loadComponents()
    {
        self::$config = parse_ini_file(APP_ROOT.'app/config/config.ini', true);

        $this->append(new HttpRequest(), 'HttpRequest');
        $this->append(new HttpResponse(), 'HttpResponse');
        $this->append(new Router(), 'Router');
        $this->append(new Template(), 'Template');

        $database = Database::getInstance();
        $database->setDataAccess( new PDO('mysql:host=localhost;dbname=game','root','root') );
        $this->append($database, 'Database');
    }

    /**
     * RUNNING APPLICATION
     */
    private function runningApplication()
    {
        $router = $this->getComponent('Router');
        $this->action($router->getController(), $router->getAction());
    }

    /**
     * Launch Controller
     */
    private function action(string $controller, string $action)
    {
        //ctrl
        $controller = ucfirst($controller.'Controller');

        $ctrl = new $controller;
        $this->append($ctrl, $controller);
        $act = strtolower($action).'Action';

        //action
        if(method_exists($ctrl, $act)) {
            $ctrl->setView($action);
            $ctrl->$act();
            $vue = $ctrl->getPage();
        } else 
            throw new BadMethodCallException("L'action '$action' de $controller n'exists pas");

        if(is_string($vue))
            if(!empty($vue))
                echo $vue;
        return null;
    }

    /**
     *  todo: collection
     * 
     */
    private function append(ApplicationComponentInterface $component, $name)
    {
        $component->inject($this);
        $this->components[$name] = $component;
    }
}