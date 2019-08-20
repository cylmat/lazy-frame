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
    private $_template;
    private $_vue;
    private $_generatedPage='';

    function setTemplate(string $templatePath)
    {
        if (!file_exists($templatePath)) {
            $this->_template = '';
        } else {
            $this->_template = $templatePath;
        }
    }

    function setVue(string $viewPath)
    {
        if (!file_exists($viewPath)) {
            throw new \InvalidArgumentException("Le fichier $viewPath n'existe pas.");
        }
        
        $this->_vue = $viewPath;
    }

    
    function setRawContent(string $content)
    {
        $this->_generatedPage = html_entity_decode($$content, ENT_COMPAT, 'UTF-8');
    }

    /**
     * Rendered page
     */
    function getPage(array $params=[]): string
    {
        $this->_parse($params);
        return $this->_generatedPage;
    }

    /**
     * Parse a Html string
     * Insert params into
     */
    private function _parse(array $params)
    {
        extract($params);

        //vue
        if (file_exists($this->_vue)) {
            ob_start();
            include $this->_vue;
            $content = ob_get_contents();
            ob_end_clean();
        } else {
            throw new \RunTimeException("File doesn't exists "{$this->_vue});
        }

        //template
        if (file_exists($this->_template)) {
            ob_start();
            include $this->_template;
            $content = ob_get_contents();
            ob_end_clean();
        }
        $this->_generatedPage = $content;
    }
}
