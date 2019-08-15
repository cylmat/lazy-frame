<?php

interface RouterInterface
{
    function getController( ): string;
    function getAction(): string;
}