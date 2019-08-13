<?php 

error_reporting(-1); //E_ALL
ini_set('display_errors', 1);

define('APP_ROOT', __DIR__.'/../');

require APP_ROOT.'app/autoload.php';

/**
 * Test
 */
class Test 
{
    static function run()
    {
        $back = [];
        $back['persos'] = self::getPersos();

        self::init();
        //self::setRepo($back);
        //self::runGame($back);

        echo Logger::$log; 
    }

    static function getPersos()
    {
        $p1 = new PersoEntity;
        $p1->setId(1);
        $p1->setName('Alphonse');
        $p1->setLife(100);
        $p1->setClass('Warrior');
        $p1->setForce(3);

        $p2 = new PersoEntity;
        $p2->setId(2);
        $p2->setName('Bob');
        $p2->setLife(100);
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
    }

    static function setRepo($back)
    {
        $p1 = $back['persos'][0];
        $persoRepo = new PersoRepository( Database::getInstance() );
        $persoRepo->insert($p1);
    }

    static function runGame($back)
    {
        $persos = $back['persos'];
        $perso1 = new PersoManager($persos[0]);
        $perso2 = new PersoManager($persos[1]);

        $perso1->attack( $perso2 );
        Logger::assert(100===$perso1->get()->getLife(), 'Perso1');
        Logger::assert(97===$perso1->get()->getLife(), 'Perso1');
    }
}

Test::run();