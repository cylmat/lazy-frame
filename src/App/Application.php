<?php

class Application 
{
    use SingletonTrait;

    private $components=[];

    static function run()
    {
        self::getInstance();
    }

    public function getComponent(string $name)
    {
        if(isset($this->components[$name]))
            return $this->components[$name];
        return false;
    }

    private function __construct()
    {
        $this->loadComponents();
        $this->runningApplication();
    }

    private function loadComponents()
    {
        $this->append(new HttpRequest(), 'HttpRequest');
        $this->append(new HttpResponse(), 'HttpResponse');
        $this->append(new Router(), 'Router');
        //$this->append(new Controller(), 'Controller');
        //$this->append(new Database(), 'Database');
        //$this->append(new Entity(), 'Entity');
        //$this->append(new Repository(), 'Repository');
    }

    /**
     * RUNNING APPLICATION
     */
    private function runningApplication()
    {
        $router = $this->getComponent('Router');
        //$router->getRoute();
        //$controller = $this->getController($route);
        //$action = $this->getAction($route);

        $this->action($router->getController(), $router->getAction());
    }

    /**
     * Launch Controller
     */
    private function action(string $controller, string $action)
    {
        $controller = ucfirst('default');
        $action = strtolower('index').'Action';

        //ctrl
        $controller = $controller.'Controller';
        $ctrl = new $controller;

        //action
        if(method_exists($ctrl, $action))
            $vue = $ctrl->$action();
        else {
            echo "L'action '$action' de $controller n'exists pas";
        }

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

    /*private function getRoute()
    {
        $router = $this->getComponent('Router');
        return $router->getRoute();
    }*/
}