<?php

error_reporting(-1); //E_ALL
ini_set('display_errors', 1);
ini_set('xdebug.var_display_max_children',-1);
ini_set('xdebug.var_display_max_data',-1);
ini_set('xdebug.var_display_max_depth',-1);
        
    

define('APP_ROOT', __DIR__.'/');

require APP_ROOT.'app/autoload.php';

Application::run();

echo Logger::$log;