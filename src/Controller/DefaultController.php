<?php

namespace Controller;

use Core\Component\Controller;
use Entity\PersoEntity;
use Repository\PersoRepository;

class DefaultController extends Controller
{
    function indexAction() 
    { 
        $perso = new PersoEntity;
        $perso->setName(8);
        $perso->setLife(50);
        $perso->setClass('warrior');
        $perso->setForce(8);
       
        $persoRepo = new PersoRepository( $this->getComponent('Database') );
        $r = $persoRepo->create($perso);

        $this->renderVue();
    }
}