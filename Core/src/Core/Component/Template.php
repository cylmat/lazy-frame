<?php declare(strict_types = 1);

namespace Core\Component;

use Core\Kernel\ApplicationComponent;
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
    private $_renderPage='';
    private $_params=[];

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
        $this->_renderPage = html_entity_decode($content, ENT_COMPAT, 'UTF-8');
    }

    /**
     * Rendered page
     */
    function render(array $params=[]): string
    {
        $this->addParams($params);
        $this->_parse();
        return $this->_renderPage;
    }

    function addParams(array $params)
    {
        $this->_params = $this->_params + $params;
    }

    /**
     * Parse a Html string
     * Insert params into
     */
    private function _parse()
    {
        extract($this->_params);

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
        $this->_renderPage = $content;
    }
}
