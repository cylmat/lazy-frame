<?php declare(strict_types = 1);

namespace Core\Component;

use Core\Contract\ControllerInterface;
use Core\Component\ApplicationComponent;
use Core\Component\Template;
use Core\Component\Application;

class Controller extends ApplicationComponent implements ControllerInterface
{
    /**
     * Template object
     */
    private $_template = null; 

    function __construct(&$container)
    {
        $this->container = $container;
    }

    /**
     * Render pur html string
     */
    function renderRaw(string $html): Template
    {
        $this->_template->setRawContent($html); 
        return $this->_template;
    }

    /**
     * Render template
     */
    function renderVue(array $params=[]): Template
    {
        $this->_template->addParams($params);
        return $this->_template;
    }

    function setView(string $actionName)
    {
        $this->_template = new Template();

        $controllerName = explode('\\', static::class);
        if (count($controllerName)!==3) {
            throw new \Exception("Controller name invalid");
            return false;
        }

        $viewDir =  APP_ROOT . Application::$config->app->view_path; 

        $templatePath = $viewDir . DIR_SEP . strtolower($controllerName[0]) . 
            DIR_SEP . Application::$config->view->layout_name . Application::$config->view->file_ext;

        $viewPath = $viewDir . DIR_SEP . strtolower($controllerName[0]) . 
            DIR_SEP . strtolower(str_replace('Controller', '', $controllerName[2])) . 
            DIR_SEP . $actionName . Application::$config->view->file_ext;

        $this->_template->setTemplate($templatePath);
        $this->_template->setVue($viewPath);
    }

    function getPage(): Template
    {
        return $this->_template;
    }
}