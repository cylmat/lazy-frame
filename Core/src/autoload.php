<?php

namespace Core;

defined('CORE_ROOT') OR define('CORE_ROOT', realpath(__DIR__.'/../').'/');
require CORE_ROOT.'src/Tool/Autoload.php'; 

new Tool\Autoload(CORE_ROOT);