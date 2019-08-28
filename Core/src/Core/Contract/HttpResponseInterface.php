<?php declare(strict_types = 1);

namespace Core\Contract;

use Core\Contract\TemplateInterface;

interface HttpResponseInterface
{
    function redirect(string $url, int $code): void;
    function setCookie(array $params): void;
    function setPage(TemplateInterface $page): void;
    function send(): void;
}
