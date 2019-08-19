<?php

namespace Core\Contract;

use Core\Contract\ApplicationInterface;
use Core\Contract\ApplicationComponentInterface;

interface ApplicationComponentInterface 
{
    function inject(ApplicationInterface $app);
}