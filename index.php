<?php

define('ENV', 'DEV');
define('APP_ROOT', __DIR__.'/');

use Core\Component\Application;

if('DEV'===ENV) {
    error_reporting(-1); //E_ALL
    ini_set('display_errors', 1);
    ini_set('xdebug.var_display_max_children',-1);
    ini_set('xdebug.var_display_max_data',-1);
    ini_set('xdebug.var_display_max_depth',-1);
}

require APP_ROOT.'app/autoload.php';

Application::run();