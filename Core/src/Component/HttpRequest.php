<?php

namespace Core\Component;

use Core\Abstracts\ApplicationComponent;
use Core\Contract\HttpRequestInterface;

/*
    Class HttpRequest
    
    [
        'HTTP_HOST' => 'web:8888',
        'HTTP_ACCEPT_LANGUAGE' => 'fr,fr-FR;q=0.8,en-US;q=0.5,en;q=0.3',
        'HTTP_ACCEPT_ENCODING' => 'gzip, deflate',
        'SERVER_NAME' => 'web', //SERVER_PORT
        'REQUEST_SCHEME' => 'http sgdfgd',
        'SCRIPT_FILENAME' => 'D:/web-server/web/tests/testRouter.php',
        'SERVER_PROTOCOL' => 'HTTP/1.1',
        'REQUEST_METHOD' => 'GET',
        'QUERY_STRING' => 'ctrl=alpha&test=unit&uniq=45',
        'REQUEST_URI' => '/tests/testRouter.php?ctrl=alpha&test=unit&uniq=45',
        'SCRIPT_NAME' => '/tests/testRouter.php',
        'PHP_SELF' => '/tests/testRouter.php'
    ];
*/
class HttpRequest extends ApplicationComponent implements HttpRequestInterface
{
    private $get, $post;

    function __construct()
    {
        
    }

    /**
     * TODO secure
     */
    function get()
    {
        return $_GET;
    }

    /**
     * TODO secure
     */
    function post()
    {
        return $_POST;
    }

    /**
     * TODO secure
     */
    function cookie()
    {
        return $_COOKIE;
    }

    function getRequestUri():string
    {
        //REQUEST_URI
        return self::gettingValue('REQUEST_URI');
    }

    function getCode()
    {
        return http_response_code();
    }

    function getProtocol()
    {
        //SERVER_PROTOCOL
        return self::gettingValue('SERVER_PROTOCOL');
    }

    function getMethod():string
    {
        //REQUEST_METHOD
        return self::gettingValue('REQUEST_METHOD');
    }

    function getQueryString()
    {
        //QUERY_STRING
        return self::gettingValue('QUERY_STRING');
    }

    function getScriptName()
    {
        return self::gettingValue('SCRIPT_NAME');
    }

    function getScheme()
    {
        return self::gettingValue('REQUEST_SCHEME');
    }

    /**
     * VAalues
     */
    static function gettingValue($val)
    {
        if(isset($_SERVER[$val]))
            return filter_input(INPUT_SERVER, $val, FILTER_SANITIZE_STRING);
        return $val;
    }
}