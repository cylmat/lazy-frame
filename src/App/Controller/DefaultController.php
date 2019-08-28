<?php

namespace App\Controller;

use Core\Kernel\Controller;
use App\Entity\UserEntity;
use App\Repository\UserRepository;

class DefaultController extends Controller
{
    function indexAction() 
    { 
        /*$user = new UserEntity;
        $user->setName('Michel');
       
        $userRepo = new UserRepository( $this->container->get('Database') );
        $r = $userRepo->create($user);*/

        $this->renderVue();
    }

    function userAction()
    {

    }
}