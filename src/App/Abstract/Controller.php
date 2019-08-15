<?php

abstract class Controller extends ApplicationComponent implements ControllerInterface
{
    const VIEW_EXT = '.html.php';

    /**
     * Template object
     */
    protected $page = null; 

    /**
     * Render pur html string
     */
    function render(string $html)
    {
        //$this->page = new Template();
        $this->page->setRawContent( $html ); 
        return $this->getPage();
    }

    /**
     * Get generated Html
     */
    function getPage()
    {
        return $this->page->getPage();
    }

    /**
     * Render template
     */
    function renderVue(array $params=[])
    {
        //$this->page = new Template();
        $this->page->parse($params);
        return $this->getPage();
    }

    function setView(string $actionName)
    {
        $this->page = new Template();

        $viewPath = APP_ROOT . Application::$config['APP']['view_path']; 
        $viewPath .= '/'.strtolower(str_replace('Controller','',static::class));

        $templatePath = $viewPath . '/template' . self::VIEW_EXT;
        $viewPath .= '/'.$actionName . self::VIEW_EXT;

        $this->page->setTemplate($templatePath);
        $this->page->setVue($viewPath);
    }
}