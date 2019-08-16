<?php

namespace Repository;

use Core\Component\Repository;

class PersoRepository extends Repository
{   
    /**
     * Update
     */
    /*public function update(EntityInterface $entity, array $newParams): bool
    {
        $this->hydrate($entity, $newParams);
        
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
    }*/

    /**
     * Get
     */
    /*public function getFromId( int $id ): ?object
    {
        $sql = "SELECT * FROM ".$this->DB_NAME." WHERE id={$id}";
        $smt = $this->db->prepare($sql);
        $ret = $smt->execute();

        if($ret) {
            $perso = new PersoEntity();
            $this->hydrate( $perso, $smt->fetchAll()[0] );
            return $perso;
        }
        return null;
    }*/

    /**
     * List
     */
    /*public function list(): ?array
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
    }*/

    /**
     * Delete
     */
    /*public function deleteId($id): bool
    {
        $delete_sql = "
DELETE FROM ".$this->DB_NAME." 
WHERE id=:id
";

        $smt = $this->db->prepare($delete_sql);
        $smt->bindValue(':id', $id, PDO::PARAM_INT);
        return $smt->execute();
    }*/
    
    /**
     * Create Database
     */
    public function createDatabase(): bool
    {
        $create_sql = "
CREATE TABLE IF NOT EXISTS ".$this->DB_NAME." (
id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
name VARCHAR(100),
life SMALLINT,
class VARCHAR(20),
level INT,
`force` INT
) ENGINE=MyISAM;
";

        $smt = $this->db->prepare($create_sql);
        return  $smt->execute();
    }
}