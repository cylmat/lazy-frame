<?php

namespace Game\Controller;

use Core\Component\Controller;

class PersoController extends Controller
{
    function indexAction() 
    { 
        //$persoRepo = new PersoRepository( $this->getComponent('Database') );
        //$list = $persoRepo->list();
        $list=[];
        $this->renderVue([
            'hector'=>'boulliez',
            'list'=>$list
        ]);
    }
}