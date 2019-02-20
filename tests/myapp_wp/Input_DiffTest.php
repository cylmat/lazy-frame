<?php

//use PHPUnit\Framework\TestCase;
include __DIR__.'/../../myapp_wp/includes_app.php';

class Input_DiffTest extends PHPUnit_Framework_TestCase {
    
    public function testGetting()
    {
        $a = new Input_Diff();
        
        $f = $a->get_dialog(5);
        //$f=4;
        //echo $f.' ert';
        $this->assertTrue(true);
        $this->assertSame($f,6);
    }
    
   
}
