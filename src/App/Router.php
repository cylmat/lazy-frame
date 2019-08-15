<?php

/**
 * Router
 */
class Router
{
    use SingletonTrait;

    static function route()
    {
        $self = self::getInstance();
        $response = new HttpResponse;
        $ctrl = $self->getControllerName($response);
    }

    private function getControllerParams(HttpResponse $response)
    {

    }

    private function getControllerName(HttpResponse $response): string
    {
        //check if controller exists
        var_dump($response->get());
    }

    private function redirectToController()
    {

    }

    /*function getRequest()
    {

    }*/
}