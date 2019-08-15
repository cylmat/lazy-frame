<?php

abstract class Repository
{
    use HydrateTrait;

    protected $db;
    protected $DB_NAME;

    public function __construct( Database $db )
    {
        $this->db = $db;
        $this->DB_NAME = str_replace('Repository','',static::class);
    }

    public function getLastInsertId(): int
    {
        return (int)$this->db->lastInsertId();
    }

    abstract function create( PersoEntity $perso ): bool;
    abstract function update(PersoEntity $perso, array $newParams): bool;
    abstract function getFromId( int $id ): ?object;
    abstract function list(): ?array;
    abstract function deleteId($id): bool;
    abstract function createDatabase(): bool;
}