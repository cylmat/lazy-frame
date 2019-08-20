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
    protected $template = null; 

    /**
     * Render pur html string
     */
    function renderRaw(string $html)
    {
        $this->template->setRawContent( $html ); 
        return $this->template->getPage();
    }

    /**
     * Render template
     */
    function renderVue(array $params=[])
    {
        return $this->template->getPage($params);
    }

    function setView(string $actionName)
    {
        $this->template = new Template();

        $controllerName = explode(DIR_SEP,static::class);
        if(count($controllerName)!==3) {
            throw new \Exception("Controller name invalid");
            return false;
        }

        $viewDir =  APP_ROOT . Application::$config->app->view_path; 

        $templatePath = $viewDir . DIR_SEP . strtolower($controllerName[0]) . 
            DIR_SEP . Application::$config->view->layout_name . Application::$config->view->file_ext;

        $viewPath = $viewDir . DIR_SEP . strtolower($controllerName[0]) . 
            DIR_SEP . strtolower(str_replace('Controller','',$controllerName[2])) . 
            DIR_SEP . $actionName . Application::$config->view->file_ext;

        $this->template->setTemplate($templatePath);
        $this->template->setVue($viewPath);
    }

    function getPage():string
    {
        return $this->template->getPage();
    }
}