<?php


//ini_set('error_reporting', E_ALL); // or error_reporting(E_ALL);
//ini_set('display_errors', '1');
//ini_set('display_startup_errors', '1');

//use PHPUnit\Framework\TestCase;


require __DIR__ . '/../../../application/classes/Diff.php';

use Diff;


/*namespace PHPUnit\Framework;

class TestCase extends \PHPUnit_Framework_TestCase {
  // (everything here)
}*/


class DiffTest extends PHPUnit_Framework_TestCase {
    
    public function testGetting()
    {
        $a = new Diff\Diff();
        
        //$f = $a->getDialog(5);
        //$f=4;
        //echo $f.' ert';
        $this->assertTrue(true);
        $this->assertSame($f,6);
        $this->assertSame($f,149875);
        $this->assertSame($f,2);
        $this->assertSame($f,2);
        $this->assertSame($f,2);     
    }
    
   
}
