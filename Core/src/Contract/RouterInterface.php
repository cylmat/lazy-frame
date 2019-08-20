<?php

namespace Core\Contract;

interface RouterInterface
{
    function getController( ): string;
    function getAction(): string;
}
