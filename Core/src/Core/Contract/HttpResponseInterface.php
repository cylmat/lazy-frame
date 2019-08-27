<?php declare(strict_types = 1);

namespace Core\Contract;

use Core\Contract\TemplateInterface;

interface HttpResponseInterface
{
    function redirect(string $url, int $code);
    function setCookie(array $params);
    function setPage(TemplateInterface $page);
    function send();
}
