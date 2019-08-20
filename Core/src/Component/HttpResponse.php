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

    function setSession()
    {

    }

    /**
     * Print page response
     */
    function send(): ?string
    {
        if (is_string($this->_page)) {
            echo ( $this->_page );
        }
        return null; 
    }
}
