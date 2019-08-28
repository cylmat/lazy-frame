<?php declare(strict_types = 1);

namespace Core\Contract;

use Core\Contract\ApplicationComponentInterface;
use Core\Kernel\ApplicationComponent;

interface ComponentFactoryInterface
{
    public static function create(string $componentName, array $constructorParams): ApplicationComponent;
}
