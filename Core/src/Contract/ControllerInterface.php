<?php

namespace Core\Contract;

interface ControllerInterface
{
    function renderRaw(string $html);
    function renderVue(array $params=[]);
    function setView(string $actionName);
}
