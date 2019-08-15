<?php

interface HttpResponseInterface
{
    function redirect(string $url, int $code);
    function setCookie(array $params);
    function setPage();
}