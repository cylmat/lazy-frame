<?php

use PHPUnit\Framework\TestCase;
use Core\Component\Container;
use Core\Contract\ApplicationComponentInterface;

class ContainerTest extends TestCase
{
    public function setUp(): void
    {
       
    }

    public function testCanLoadComponent()
    {
        $container = new Container;
        $this->assertTrue($container->load('HttpResponse'));

        $this->assertTrue(
            in_array(ApplicationComponentInterface::class, class_implements($container->get('HttpResponse')))
        );
        
        //false
        $this->expectException(InvalidArgumentException::class);
        $container->load('WrongComponent');
    }

    public function testCanLoadConstructor()
    {
        $container = new Container;
        $container->load('Database',[]);

        $this->expectException(ArgumentCountError::class);
        $container->get('Database');
    }
}