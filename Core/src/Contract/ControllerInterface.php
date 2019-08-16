<?php

namespace Core\Contract;

interface ControllerInterface
{
    function render(string $html);
}