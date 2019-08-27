<?php

namespace App\Repository;

use Core\Component\Repository;

class UserRepository extends Repository
{   
    /**
     * Create Database
     */
    public function createDatabase(): bool
    {
        $create_sql = "
CREATE TABLE IF NOT EXISTS ".$this->DB_NAME." (
id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
name VARCHAR(100),
email VARCHAR(200)
) ENGINE=MyISAM;
";

        $smt = $this->db->prepare($create_sql);
        return  $smt->execute();
    }
}