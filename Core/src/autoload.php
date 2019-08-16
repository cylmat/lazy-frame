<?php

namespace Core;

defined('CORE_ROOT') OR define('CORE_ROOT', realpath(__DIR__.'/../').'/');
include CORE_ROOT.'src/Component/Autoload.php';

$autoload = new Component\Autoload(CORE_ROOT);