<?php

namespace App\Controller;

use Core\Component\Controller;
use App\Entity\UserEntity;
use App\Repository\UserRepository;

class DefaultController extends Controller
{
    function indexAction() 
    { 
        $user = new UserEntity;
        $user->setName('Michel');
       
        $userRepo = new UserRepository( $this->getComponent('Database') );
        $r = $userRepo->create($user);

        $this->renderVue();
    }

    function userAction()
    {

    }
}