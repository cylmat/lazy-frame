<?php

define('ENV', 'DEV');
define('DIR_SEP', DIRECTORY_SEPARATOR);
define('APP_ROOT', __DIR__.DIR_SEP);

use Core\Kernel\Application;
use Core\Tool\Config;

if('DEV'===ENV) {
    error_reporting(-1); //E_ALL
    ini_set('display_errors', 1);
    ini_set('xdebug.var_display_max_children',-1);
    ini_set('xdebug.var_display_max_data',-1);
    ini_set('xdebug.var_display_max_depth',-1);
}

require APP_ROOT.'app/autoload.php';

Application::run( Config::get(APP_ROOT.'app/config/config.ini') );