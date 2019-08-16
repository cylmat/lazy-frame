<?php

namespace Core\Component;

use Core\Abstracts\ApplicationComponent;
use Core\Contract\HttpResponseInterface;

class HttpResponse extends ApplicationComponent implements HttpResponseInterface
{
    function redirect(string $url, int $code)
    {

    }

    function setCookie(array $params)
    {

    }

    function setPage()
    {
        
    }

    function setSession()
    {

    }
}