<?php

namespace Core\Contract;

use Core\Component\Application;
use Core\Contract\ApplicationComponentInterface;

interface ApplicationComponentInterface
{
    function inject(Application &$app);
}
