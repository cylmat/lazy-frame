<?php

class Application 
{
    use SingletonTrait;

    private $components=[];
    /*private $request;
    private $response;
    private $router;
    private $render;*/

    static function run()
    {
        self::getInstance();
    }

    function __construct()
    {
        $this->append(new HttpRequest(), 'HttpRequest');
        $this->append(new HttpResponse(), 'HttpResponse');
        $this->append(new Router(), 'Router');
    }

    /**
     *  todo: object collection
     * 
     */
    function append(ApplicationComponentInterface $component, $name)
    {
        $component->inject($this);
        $this->components[$name] = $component;
    }

    function getController()
    {

    }
}