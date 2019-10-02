<?php

namespace App\Controller;

use Core\Kernel\Controller;
use App\Entity\UserEntity;
use App\Repository\UserRepository;

class DefaultController extends Controller
{
    function indexAction() 
    { 
        $data = require __DIR__.'/../Data/data.php';
        $this->renderVue();
    }
}