<?php declare(strict_types = 1);

namespace Core\Kernel;

use Core\Contract\ControllerInterface;
use Core\Component\Template;

class Controller implements ControllerInterface
{
    /**
     * Template object
     */
    private $_template = null; 

    /**
     * Configuration
     */
    private $config;

    public function __construct(&$container, $config)
    {
        $this->container = $container;
        $this->config = $config;
    }

    /**
     * Render pur html string
     */
    public function renderRaw(string $html): Template
    {
        $this->_template->setRawContent($html); 
        return $this->_template;
    }

    /**
     * Render template
     */
    public function renderVue(array $params=[]): Template
    {
        $this->_template->addParams($params);
        return $this->_template;
    }

    public function setView(string $actionName)
    {
        $this->_template = $this->container->get('Template');

        $controllerName = explode('\\', static::class);
        if (count($controllerName)!==3) {
            throw new \Exception("Controller name invalid");
            return false;
        }

        $viewDir =  APP_ROOT . $this->config->app->view_path; 

        $templatePath = $viewDir . DIR_SEP . strtolower($controllerName[0]) . 
            DIR_SEP . $this->config->view->layout_name . $this->config->view->file_ext;

        $viewPath = $viewDir . DIR_SEP . strtolower($controllerName[0]) . 
            DIR_SEP . strtolower(str_replace('Controller', '', $controllerName[2])) . 
            DIR_SEP . $actionName . $this->config->view->file_ext;

        $this->_template->setTemplate($templatePath);
        $this->_template->setVue($viewPath);
    }

    public function getPage(): Template
    {
        return $this->_template;
    }
}
