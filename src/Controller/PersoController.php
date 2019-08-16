<?php

class PersoController extends Controller
{
    function biduleAction() 
    { 
        $persoRepo = new PersoRepository( $this->getComponent('Database') );
        $list = $persoRepo->list();

        $this->renderVue([
            'hector'=>'boulliez',
            'list'=>$list
        ]);
    }
}