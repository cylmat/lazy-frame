<?php

namespace Core\Contract;

interface HttpResponseInterface
{
    function redirect(string $url, int $code);
    function setCookie(array $params);
    function setPage(string $page);
    function send(): ?string;
}