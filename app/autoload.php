<?php

include __DIR__.'/../core/src/autoload.php';

$autoload = new Core\Component\Autoload;
$autoload->addPath(APP_ROOT);

spl_autoload_register([$autoload, 'load']);