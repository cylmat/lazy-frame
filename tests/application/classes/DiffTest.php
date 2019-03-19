<?php


//ini_set('error_reporting', E_ALL); // or error_reporting(E_ALL);
//ini_set('display_errors', '1');
//ini_set('display_startup_errors', '1');

//use PHPUnit\Framework\TestCase;


//require __DIR__ . '/../../../application/classes/Diff.php';


use Application\Classes\Diff;


/*namespace PHPUnit\Framework;

class TestCase extends \PHPUnit_Framework_TestCase {
  // (everything here)
}*/

/*
 * ,
        "psr-4": { 
            "Application\\":"application/",
            "Application\\classes\\":"application/classes/"
        },
        "classmap": [
            "application/classes/Diff.php",
            "application/classes"
        ]
 */


class DiffTest extends PHPUnit_Framework_TestCase {
    
    public function testGetting()
    {
        $a = new Application\classes\Diff();
        
        //$f = $a->getDialog(5);
        $f=4;
        //echo $f.' ert';
        $this->assertTrue(true);
        $this->assertSame($f,9);
    }
    
   
}
