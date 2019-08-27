<?php declare(strict_types = 1);

namespace Core\Contract;

interface TemplateInterface
{
    function setTemplate(string $templatePath);
    function setVue(string $viewPath);
    function setRawContent(string $content);
    function addParams(array $params);
    function render(array $params=[]): string;
}
