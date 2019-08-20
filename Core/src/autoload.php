<?php

namespace Core;

defined('CORE_ROOT') OR define('CORE_ROOT', realpath(__DIR__.'/../').'/');
include CORE_ROOT.'src/Tool/Autoload.php';

$autoload = new Tool\Autoload(CORE_ROOT);