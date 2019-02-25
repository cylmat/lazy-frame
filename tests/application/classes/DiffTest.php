<?php

//use PHPUnit\Framework\TestCase;
require __DIR__.'/../../application/classes/Diff.php';



class DiffTest extends PHPUnit_Framework_TestCase {
    
    public function testGetting()
    {
        $a = new Diff();
        
        $f = $a->get_dialog(5);
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
