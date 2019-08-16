<?php

namespace Core\Contract;

interface TemplateInterface
{
    function parse(array $params);
}