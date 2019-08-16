<?php

namespace Controller;

use Core\Component\Controller;

class DefaultController extends Controller
{
    function indexAction() 
    { 
        $this->renderVue();
    }
}