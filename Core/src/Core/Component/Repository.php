<?php declare(strict_types = 1);

namespace Core\Component;

use Core\Contract\RepositoryInterface;
use Core\Traits\HydrateTrait;
use Core\Component\Database;
use Core\Contract\EntityInterface;
use Core\Kernel\ApplicationComponent;

class Repository extends ApplicationComponent implements RepositoryInterface
{
    use HydrateTrait;

    protected $db;
    protected $DB_NAME;

    public function __construct( Database $db )
    {
        $this->db = $db;
        $this->DB_NAME = str_replace('Repository', '', str_replace('\\', '', static::class));
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
VALUES ({$cols['bind_values']});
";

        $smt = $this->db->prepare($sql);
        return $smt->execute($cols['bind_params']);
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
SET {$cols['bind_values_noid']}
WHERE {$cols['bind_values_onlyid']};
";

        $smt = $this->db->prepare($sql);
        return $smt->execute($cols['bind_params']);
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
        if ($ret) {
            $perso = new $entity();
            $this->hydrate($perso, $smt->fetchAll()[0]);
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

        if ($ret) {
            foreach ($smt->fetchAll() as $n => $persoVars) {
                $perso = new PersoEntity();
                $this->hydrate($perso, $persoVars);
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

    function createDatabase(): bool
    {
    }

    /**
     * Change results to columns data
     * 
     * Ex:  id,name,class
     *      id=:id, name=:name, ...
     */
    protected function toColumns($params)
    {
        $i=1; $return=[
            'columns'=>'', 'bind_values'=>'', 'bind_values_noid'=>'', 'bind_values_onlyid'=>'', 'bind_params'=>[]
        ];
        foreach ($params as $key => $value) {
            if (!ctype_alpha($key)) {
                throw new \InvalidArgumentException('Expected alphanumeric value ('.$key.')');
            } else {
                $sep = $i<=count($params)-1?',':'';
                $return['columns'] .= "`{$key}`$sep"; //columns
                $return['bind_values'] .= ":{$key}$sep"; //bind values
                $return['bind_params'][':'.$key] = $value;

                if (false===(strstr($key, 'id'))) { //update
                    $return['bind_values_noid'] .= "{$key}=:{$key}$sep";
                } else {  
                    $return['bind_values_onlyid'] .= "{$key}=:{$key}"; 
                }
            }
            $i++;
        }

        return $return;
    }
}
