<?php

namespace Core\Contract;

interface ControllerInterface
{
    function render(string $html);
    function getPage();
    function renderVue(array $params=[]);
    function setView(string $actionName);
}