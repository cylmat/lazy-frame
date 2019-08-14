<?php



class PersoRepository
{
    private $db;
    const PERSO_DB = 'Perso';

    public function __construct( Database $db )
    {
        $this->db = $db;
    }

    public function getLastInsertId(): int
    {
        return (int)$this->db->lastInsertId();
    }

    /**
     * Create
     */
    public function create( PersoEntity $perso ): bool
    {
        $sql = "
INSERT INTO ".self::PERSO_DB." (name, life, class, level, `force`)
VALUES (:name, :life, :class, :level, :force);
";

        $smt = $this->db->prepare($sql);
        $params = [
            ':name'=>$perso->getName(),
            ':life'=>$perso->getLife(),
            ':class'=>$perso->getClass(),
            ':level'=>$perso->getLevel(),
            ':force'=>$perso->getForce()
        ];
        return $smt->execute($params);
    }

    /**
     * Update
     */
    public function update(PersoEntity $perso, array $newParams): bool
    {
        $this->hydrate($perso, $newParams);
        
        $sql = "
UPDATE ".self::PERSO_DB." 
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
    public function getFromId( int $id ): ?PersoEntity
    {
        $sql = "SELECT * FROM ".self::PERSO_DB." WHERE id={$id}";
        $smt = $this->db->prepare($sql);
        $ret = $smt->execute();

        if($ret) {
            $perso = new PersoEntity();
            $this->hydrate( $perso, $smt->fetchAll()[0] );
            return $perso;
        }
        return null;
    }

    /**
     * List
     */
    public function list()
    {
        $sql = "SELECT * FROM ".self::PERSO_DB."";
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
    public function deleteId($id)
    {
        $delete_sql = "
DELETE FROM ".self::PERSO_DB." 
WHERE id=:id
";

        $smt = $this->db->prepare($delete_sql);
        $smt->bindValue(':id', $id, PDO::PARAM_INT);
        return $smt->execute();
    }
    
    /**
     * Create Database
     */
    public function createDatabase(): bool
    {
        $create_sql = "
CREATE TABLE IF NOT EXISTS ".self::PERSO_DB." (
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

    /**
     * Hydrate
     */
    private function hydrate( PersoEntity &$perso, array $values ): bool
    {
        foreach( $values as $col => $value )
        {
            if(!is_string($col)) continue;
            $setMethod = 'set'.ucfirst($col);
            $perso->$setMethod($value);
        }
        return true;
    }
}