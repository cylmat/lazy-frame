<?php

interface RouterInterface
{
    //function setAction(string $action);
    //function setController(ControllerInterface $controller);
    function getController( ): string;
    function getAction():string;
}