<?php

/** 
 * Declaration de package.
 * 
 * PHP Version 5.6
 * 
 * @category Exponentielle
 * @package  MyPackage
 * @author   It's me <username@example.com>
 * @license  Licence name http://license.com
 * @link     http://license.com
 */

namespace Application\Classes;

/** 
 * Class Diff
 * 
 * PHP Version 5.6
 * 
 * @category Exponentielle
 * @package  MyPackage
 * @author   It's me <username@example.com>
 * @license  Licence name http://license.com
 * @link     http://license.com
 */
class Diff
{
    /**
     * Doc commenting
     * 
     * Commentaire
     *
     * @param  string $xpress Le choix est fait
     * @return void Le retournement de situation
     */
    public function getDialog($xpress)
    {
        $too_late=4;
        $jungle=2;
        
        if($too_late)
        {
            if($jungle)
                print '1';
            else
                print '2';
        }
        else
        {
            print 'e';
            if(2) print '5';
            else print 'E';
        }
        
        return $xpress+5;
        
        if($too_late)
        {
            if($jungle)
                print '1';
            else
                print '2';
        }
        else
        {
            print 'e';
            if(2) print '5';
            else print 'E';
        }
    }
    
    
    public function doublef() { echo 'double :)'; }
}