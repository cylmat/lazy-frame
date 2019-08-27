<?php declare(strict_types = 1);

namespace Core;

defined('CORE_ROOT') OR define('CORE_ROOT', realpath(__DIR__.'/../../').'/');
require CORE_ROOT.'src/Core/Tool/Autoload.php'; 

Tool\Autoload::addPath(CORE_ROOT); //for Core
