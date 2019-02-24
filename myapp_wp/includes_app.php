<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */




class Input_Diff {
    
    function get_dialog($a)
    {
        return ++$a;
    }
    
    function echo_dialog()
    {
        echo $this->get_dialog(4);
    }
    
}