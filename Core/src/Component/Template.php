<?php

namespace Core\Component;

use Core\Component\ApplicationComponent;
use Core\Contract\TemplateInterface;

/**
 * Template
 * 
 * Called by Controller
 */
class Template extends ApplicationComponent implements TemplateInterface
{
    private $template;
    private $vue;
    private $generatedPage='';

    function setTemplate(string $templatePath)
    {
        if(!file_exists($templatePath))
            $this->template = '';
        else
            $this->template = $templatePath;
    }

    function setVue(string $viewPath)
    {
        if(!file_exists($viewPath))
            throw new \InvalidArgumentException("Le fichier $viewPath n'existe pas.");
        
        $this->vue = $viewPath;
    }

    
    function setRawContent(string $content)
    {
        $this->generatedPage = html_entity_decode($$content, ENT_COMPAT, 'UTF-8');
    }

    /**
     * Rendered page
     */
    function getPage(array $params=[]): string
    {
        $this->parse($params);
        return $this->generatedPage;
    }

    /**
     * Parse a Html string
     * Insert params into
     */
    private function parse(array $params)
    {
        extract($params);

        //vue
        ob_start();
        include $this->vue;
        $content = ob_get_contents();
        ob_end_clean();

        //template
        if(file_exists($this->template)) {
            ob_start();
            include $this->template;
            $content = ob_get_contents();
            ob_end_clean();
        }
        $this->generatedPage = $content;
    }
}