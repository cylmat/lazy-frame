<?php

namespace Core\Component;

use Core\Component\ApplicationComponent;
use Core\Component\HttpResponse;

/**
 * Class Kernel
 * 
 * Coeur de l'application
 * Recupère la requète http et renvoi la réponse http
 */
class Kernel extends ApplicationComponent
{
    /**
     * Launch Controller
     */
    public function getResponse(string $module, string $controller, string $action): HttpResponse
    {
        //ctrl
        $controller = ucfirst($module) . '\\Controller\\'.ucfirst($controller.'Controller');

        $ctrl = new $controller;
        $act = strtolower($action).'Action';

        //action
        if(method_exists($ctrl, $act)) {
            $ctrl->setView($action);
            $ctrl->$act();
            $this->httpResponse->setPage( $ctrl->getPage() );
            return $this->httpResponse;
        } else 
            throw new \BadMethodCallException("L'action '$action' de $module\\$controller n'exists pas");

        return false;
    }
}