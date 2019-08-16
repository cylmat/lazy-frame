<?php

namespace Core\Component;

use Core\Abstracts\ApplicationComponent;
use Core\Contract\TemplateInterface;

class Template extends ApplicationComponent implements TemplateInterface
{
    private $template;
    private $vue;
    private $generatedPage='';

    function setTemplate(string $templatePath)
    {
        if(!file_exists($templatePath))
            throw new \InvalidArgumentException("Le fichier $templatePath n'existe pas.");

        $this->template = $templatePath;
    }

    function setVue(string $viewPath)
    {
        if(!file_exists($viewPath))
            throw new \InvalidArgumentException("Le fichier $viewPath n'existe pas.");
        
        $this->vue = $viewPath;
    }

    /**
     * Parse a Html string
     * Insert params into
     */
    function parse(array $params)
    {
        extract($params);

        //vue
        ob_start();
        include $this->vue;
        $content = ob_get_contents();
        ob_end_clean();

        //template
        ob_start();
        include $this->template;
        $page = ob_get_contents();
        ob_end_clean();
        $this->generatedPage = $page;
    }

    function setRawContent(string $content)
    {
        $this->generatedPage = html_entity_decode($$content, ENT_COMPAT, 'UTF-8');
    }

    /**
     * Rendered page
     */
    function getPage()
    {
        return $this->generatedPage;
    }
}