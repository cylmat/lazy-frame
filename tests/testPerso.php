<?php 

error_reporting(-1); //E_ALL
ini_set('display_errors', 1);

define('APP_ROOT', __DIR__.'/../');

require APP_ROOT.'app/autoload.php';

/**
 * Test
 */
class TestPerso
{
    static function run()
    {
        $back = [];
        $back['persos'] = self::getPersos();

        self::init();
        self::setRepo($back);

        echo Logger::$log; 
    }

    static function getPersos()
    {
        $p1 = new PersoEntity;
        $p1->setId(1);
        $p1->setName('Alphonse');
        $p1->setLife(100);
        $p1->setClass('Warrior');
        $p1->setLevel(3);
        $p1->setForce(3);

        $p2 = new PersoEntity;
        $p2->setId(2);
        $p2->setName('Bob');
        $p2->setLife(100);
        $p2->setLevel(4);
        $p2->setClass('Mage');
        $p2->setForce(4);

        return [$p1, $p2];
    }

    static function init()
    {
        $db = Database::getInstance();
        try {
            $_access = $db->setDataAccess( new PDO('mysql:host=localhost;dbname=game','root','root') );
        } catch(PDOException $e) {echo $e;}
        Logger::assert($_access===true, 'Init db');

        $persoRepo = new PersoRepository( Database::getInstance() );
        Logger::assert($persoRepo->createDatabase()!==false, 'Create PersoRepo');
    }

    static function setRepo($back)
    {
        $p1 = $back['persos'][0];
        $persoRepo = new PersoRepository( Database::getInstance() );
        $persoRepo->create($p1);
        $last = $persoRepo->getLastInsertId();
        Logger::assert($last>0, 'Perso bien crée dans BDD');

        //get
        $persoCreated = $persoRepo->getFromId($last);
        Logger::assert('PersoEntity'===get_class($persoCreated), 'Perso récupéré');

        //update
        $ok = $persoRepo->update($persoCreated, ['force'=>7]);
        Logger::assert($ok!==false, 'Perso update');
        $persoCreated = $persoRepo->getFromId($last);
        Logger::assert('7'===$persoCreated->getForce(), 'Perso update force 7');

        //list
        $persos = $persoRepo->list();
        Logger::assert(is_array($persos), 'Persos list');

        //clean
        $persoRepo->deleteId( $last );
    }

    static function runGame($back)
    {
        $persos = $back['persos'];
        $perso1 = new PersoManager($persos[0]);
        $perso2 = new PersoManager($persos[1]);

        $perso1->attack( $perso2 );
        Logger::assert(100===$perso1->get()->getLife(), 'Perso1');
        Logger::assert(97===$perso1->get()->getLife(), 'Perso2');
    }
}

TestPerso::run();