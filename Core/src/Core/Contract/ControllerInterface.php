<?php declare(strict_types = 1);

namespace Core\Contract;

interface ControllerInterface
{
    public function renderRaw(string $html);
    public function renderVue(array $params=[]);
    public function setView(string $actionName);
}
