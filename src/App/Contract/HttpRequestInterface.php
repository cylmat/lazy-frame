<?php

interface HttpRequestInterface
{
    function get();
    function post();
    function cookie();
    function getMethod():string;
    function getRequestUri():string;
}