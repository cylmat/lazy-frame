<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
header('Content-Type: text/xml');

include __DIR__.'/../includes.php';

$logxml = ROOT_PATH . 'var/logphpcs.xml';
$logxslt = APPLICATION_PATH .'log/logphpcs.xslt';

$hrefxslt = '/application/log/logphpcs.xslt';

if( file_exists($logxml) && file_exists($logxslt) )
{
    $content = file_get_contents($logxml);
    
    $content = preg_replace( '/<\?xml.?version="1.0".?encoding="UTF-8".?\?>/', '<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL.
                                '<?xml-stylesheet type="text/xsl" href="'.$hrefxslt.'"?>'.PHP_EOL, $content );
    
    echo $content;
    die();
}