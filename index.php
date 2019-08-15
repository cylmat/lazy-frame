<?php

error_reporting(-1); //E_ALL
ini_set('display_errors', 1);

define('APP_ROOT', __DIR__.'/');

require APP_ROOT.'app/autoload.php';

Application::run();

echo Logger::$log;