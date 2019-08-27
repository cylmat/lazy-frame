<?php

use PHPUnit\Framework\TestCase;
use Core\Component\Container;

class Piou
{
    function isPiou($a,$b) { }
}

class ContainerTest extends TestCase
{
    public function setUp(): void
    {

    }

    public function testCanCreateComponent()
    {
        $container  = new Container;
    }
}