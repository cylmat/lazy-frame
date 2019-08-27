<?php declare(strict_types = 1);

namespace Core\Contract;

interface Page
{
    function params(array $params);
    function setView(string $url); //view url
    function render(): string; //using template
}
