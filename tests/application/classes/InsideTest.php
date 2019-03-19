<?php


//ini_set('error_reporting', E_ALL); // or error_reporting(E_ALL);
//ini_set('display_errors', '1');
//ini_set('display_startup_errors', '1');

//use PHPUnit\Framework\TestCase;


//require __DIR__ . '/../../../application/classes/Diff.php';


use Application\Classes\Inside;


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


class InsideTest extends PHPUnit_Framework_TestCase {
    
    public function testGetting()
    {
        $a = new Application\classes\Inside();
        
        $f = $a->getMultiple(5, 2);
        //$f=4;
        //echo $f.' ert';
        //$this->assertTrue(false);
        //$this->assertSame($f,6);
        $this->assertEquals($f,149875);
        $this->assertSame($f,2);
        $this->assertSame($f,2);
        $this->assertSame($f,2);     
    }
    
   
}
