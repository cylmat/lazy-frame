<?php declare(strict_types = 1);

namespace Core\Kernel;

use Core\Contract\ComponentFactoryInterface;
use Core\Kernel\ApplicationComponent;
use Core\Traits\SingletonTrait;

class ComponentFactory implements ComponentFactoryInterface
{
    use SingletonTrait;

    public static function create(string $componentName, array $constructorParams): ApplicationComponent
    { 
        return new $componentName(...$constructorParams);
    }
}
