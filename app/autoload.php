<?php

include __DIR__.'/../Core/src/Core/autoload.php';
require __DIR__.'/../vendor/autoload.php';

defined('DIR_SEP') OR define('DIR_SEP', DIRECTORY_SEPARATOR);

error_reporting(-1); //E_ALL
ini_set('display_errors', 1);

defined('APP_ROOT') OR define('APP_ROOT', __DIR__.'/../../src/');

Core\Tool\Autoload::addPath(APP_ROOT); //for src
