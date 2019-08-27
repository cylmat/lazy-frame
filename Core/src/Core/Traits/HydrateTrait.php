<?php declare(strict_types = 1);

namespace Core\Traits;

/**
 * Hydrate
 */
trait HydrateTrait
{
    protected function hydrate( $class, array $values ): bool
    {
        foreach ($values as $col => $value) {
            if (!is_string($col)) {
                continue;
            }
            $setMethod = 'set'.ucfirst($col);
            $class->$setMethod($value);
        }
        return true;
    }
}
