<?php declare(strict_types = 1);

namespace Core\Component;

use Core\Kernel\ApplicationComponent;
use Core\Kernel\Application;
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
     * 
     * @param string $module     Module name 
     * @param string $controller Controller name
     * @param string $action     Action name
     */
    public function getResponse(string $module, string $controller, string $action): HttpResponse
    {
        //ctrl
        $controller_name = ucfirst($module) . '\\Controller\\'.ucfirst($controller.'Controller');

        $ctrl = new $controller_name($this->container, Application::$config);
        $act = strtolower($action).'Action';

        //action
        if (method_exists($ctrl, $act)) {
            $ctrl->setView($action);
            $ctrl->$act();
            
            $httpResponse = $this->container->get('HttpResponse');

            // Debug
            $httpResponse->setPageParams([
                'count'=>$this->container->count(),
                'loaded'=>$this->container->getLoaded(),
                'notLoaded'=>$this->container->getNotLoaded(),
                'action'=>$action,
                'module'=>$module,
                'controller'=>$controller,
                'bench'=>\Core\Tool\Bench::get()
            ]);
            $httpResponse->setPage($ctrl->getPage());
            return $httpResponse;
        } else { 
            throw new \BadMethodCallException("L'action '$action' de $module\\$controller n'exists pas");
        }

        return false;
    }
}
