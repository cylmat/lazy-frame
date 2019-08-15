<?php

class PersoController extends Controller
{
    function indexAction() 
    { 
        $params = ['hector'=>'boulliez'];
        $this->renderVue(
            $params
        );
    }
}