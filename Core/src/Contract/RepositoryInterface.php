<?php

namespace Core\Contract;

interface RepositoryInterface
{
    function create( EntityInterface $entity ): bool;
    function update( EntityInterface $entity, array $newParams ): bool;
    function getFromId( int $id ): ?object;
    function list(): ?array;
    function deleteId( $id ): bool;
    function createDatabase(): bool;
}
