<?php

namespace Core;

use Core\Component\HttpResponse;

class RouterTest extends \PHPUnit\Framework\TestCase
{
    public function setUp(): void
    {
       
    }

    function testCanRun()
    {
        $res = new HttpResponse();
        $this->assertTrue(true);
    }
}