<?php

namespace Core\Contract;

interface ApplicationComponentInterface 
{
    function inject(ApplicationInterface $app);
}