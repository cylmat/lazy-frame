<?php

namespace Core\Abstracts;

use Core\Traits\HydrateTrait;
use Core\Component\Database;
use Core\Contract\EntityInterface;

abstract class AbstractRepository
{
    use HydrateTrait;

    protected $db;
    protected $DB_NAME;

    public function __construct( Database $db )
    {
        $this->db = $db;
        $this->DB_NAME = str_replace('Repository','', str_replace('\\','',static::class) );
        $this->entityName = $this->DB_NAME.'Entity';
    }

    public function getLastInsertId(): int
    {
        return (int)$this->db->lastInsertId();
    }

    /**
     * Create
     */
    public function create( EntityInterface $entity ): bool
    {
        $cols = $this->toColumns($entity->gets());

        $sql = "
INSERT INTO ".$this->DB_NAME." ({$cols['columns']})
VALUES ({$cols['values']});
";

        $smt = $this->db->prepare($sql);
        return $smt->execute($cols['binds']);
    }

    /**
     * Update
     */
    public function update(EntityInterface $entity, array $newParams): bool
    {
        $this->hydrate($entity, $newParams);
        $cols = $this->toColumns($entity->gets());
        
        $sql = "
UPDATE ".$this->DB_NAME." 
SET name=:name, life=:life, class=:class, level=:level, `force`=:force
WHERE id=:id;
";

        $smt = $this->db->prepare($sql);
        $params = [
            ':id'=>$perso->getId(),
            ':name'=>$perso->getName(),
            ':life'=>$perso->getLife(),
            ':class'=>$perso->getClass(),
            ':level'=>$perso->getLevel(),
            ':force'=>$perso->getForce()
        ];
        
        return $smt->execute($params);
    }

    /**
     * Get
     */
    public function getFromId( int $id ): ?object
    {
        $sql = "SELECT * FROM ".$this->DB_NAME." WHERE id={$id}";
        $smt = $this->db->prepare($sql);
        $ret = $smt->execute();

        $entity = $this->entityName;
        if($ret) {
            $perso = new $entity();
            $this->hydrate( $perso, $smt->fetchAll()[0] );
            return $perso;
        }
        return null;
    }

    /**
     * List
     */
    public function list(): ?array
    {
        $sql = "SELECT * FROM ".$this->DB_NAME."";
        $smt = $this->db->prepare($sql);
        $ret = $smt->execute();
        $list = [];

        if($ret)
        {
            foreach($smt->fetchAll() as $n => $persoVars)
            {
                $perso = new PersoEntity();
                $this->hydrate( $perso, $persoVars );
                $list[] = $perso;
            }
            return $list;
        }
        return null;
    }

    /**
     * Delete
     */
    public function deleteId($id): bool
    {
        $delete_sql = "
DELETE FROM ".$this->DB_NAME." 
WHERE id=:id
";

        $smt = $this->db->prepare($delete_sql);
        $smt->bindValue(':id', $id, PDO::PARAM_INT);
        return $smt->execute();
    }

    /**
     * 
     */
    protected function toColumns($params)
    {
        $i=0; 
        $columns = ''; 
        $values = ''; 
        $binds = [];
        foreach($params as $key => $value)
        {
            if(!ctype_alpha($key)) {
                throw new \InvalidArgumentException('Expected alphanumeric value ('.$key.')');
            } else {
                $columns .= ($i?',':'') . "`{$key}`";
                $values .= ($i++?',':'') . ":{$key}";
                $binds[':'.$key] = $value;
            }
        }

        return [
            'columns'=>$columns,
            'values' =>$values,
            'binds' =>$binds
        ];
    }
}