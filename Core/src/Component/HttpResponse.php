<?php

namespace Core\Component;

use Core\Component\ApplicationComponent;
use Core\Contract\HttpResponseInterface;

class HttpResponse extends ApplicationComponent implements HttpResponseInterface
{
    /**
     * Html page to be displayed
     * 
     * @var string
     */
    private $_page;

    private $_pageParams = [];

    function redirect(string $url, int $code)
    {

    }

    function setCookie(array $params)
    {

    }

    function setPage(string $page)
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
     * Print page response
     */
    function send(): ?string
    {
        if (is_string($this->_page)) {
            extract($this->_pageParams);
            ob_start();
            echo $this->_page;
            ob_end_flush();
        }
        return null; 
    }
}
