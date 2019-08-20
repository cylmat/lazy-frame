<?php

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

    /**
     * Render pur html string
     */
    function renderRaw(string $html)
    {
        $this->_template->setRawContent($html); 
        return $this->_template->getPage();
    }

    /**
     * Render template
     */
    function renderVue(array $params=[])
    {
        return $this->_template->getPage($params);
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

    function getPage():string
    {
        return $this->_template->getPage();
    }
}
