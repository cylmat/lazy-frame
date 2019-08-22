<?php

namespace Core\Component;

use Core\Component\ApplicationComponent;
use Core\Contract\HttpResponseInterface;
use Core\Contract\TemplateInterface;

class HttpResponse extends ApplicationComponent implements HttpResponseInterface
{
    /**
     * Html page to be displayed
     * 
     * @var Template
     */
    private $_page;

    private $_pageParams = [];

    function redirect(string $url, int $code)
    {

    }

    function setCookie(array $params)
    {

    }

    function setPage(TemplateInterface $page)
    {
        $this->_page = $page;
    }

    function setPageParams(array $params)
    {
        $this->_pageParams = $params;
    }

    function setSession()
    {

    }

    /**
     * Print page response to output
     */
    function send()
    {
        $this->_page->addParams( $this->_pageParams );
        echo $this->_page->render();
    }
}
