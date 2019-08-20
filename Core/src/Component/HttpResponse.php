<?php

namespace Core\Component;

use Core\Component\ApplicationComponent;
use Core\Contract\HttpResponseInterface;

class HttpResponse extends ApplicationComponent implements HttpResponseInterface
{
    /**
     * @var string
     */
    private $page;

    function redirect(string $url, int $code)
    {

    }

    function setCookie(array $params)
    {

    }

    function setPage(string $page)
    {
        $this->page = $page;
    }

    function setSession()
    {

    }

    /**
     * Print page response
     */
    function send(): ?string
    {
        if(is_string($this->page)) {
            echo ( $this->page );
        }
        return null; 
    }
}
