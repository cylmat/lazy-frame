<?php

namespace Core\Contract;

interface TemplateInterface
{
    function setTemplate(string $templatePath);
    function setVue(string $viewPath);
    function setRawContent(string $content);
    function getPage(array $params=[]): string;
}