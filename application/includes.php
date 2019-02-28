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

define('ROOT_PATH', __DIR__.'/../');
define('APPLICATION_PATH', __DIR__.'/');


//kint debugging
require APPLICATION_PATH.'third/kint.phar';

//autoload
require ROOT_PATH.'vendor/autoload.php';


/**
 * master application
 */
function application_classes()
{
    echo 'r2';
    $a = new Application\Classes\Diff();
    
    $a->doublef();
}