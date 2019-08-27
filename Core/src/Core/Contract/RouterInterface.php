<?php declare(strict_types = 1);

namespace Core\Contract;

interface RouterInterface
{
    function getController( ): string;
    function getAction(): string;
}
