<?php

/**
 * Router
 */
class Router
{
    private static $instance=null;
    private function __construct() {}
    private function __clone() {}

    static function getInstance()
    {
        if(self::$instance===null) self::$instance = new self;
        return self::$instance;
    }

    static function route()
    {
        $self = self::getInstance();
        $response = new HttpResponse;

        $ctrl = $self->getControllerName($response);
        echo $ctrl;
        //$self->redirectToController();
        //$response->getParams();
    }

    private function getControllerParams(HttpResponse $response)
    {

    }

    private function getControllerName(HttpResponse $response): string
    {
        //check if controller exists
        echo 'reter';
        var_dump($response->get());
    }

    private function redirectToController()
    {

    }

    /*function getRequest()
    {

    }*/
}