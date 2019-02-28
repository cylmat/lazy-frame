<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
header('Content-Type: text/xml');


include __DIR__.'/../includes.php';

$logxml = ROOT_PATH . 'var/logphpmd.xml';
//$logxslt = __DIR__ .'/./logphpmd.xslt';

if( file_exists($logxml) )
{
    $content = file_get_contents($logxml);
    
    /* $content = preg_replace( '/<\?xml.?version="1.0".?encoding="UTF-8".?\?>/', '<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL.
                                 '<?xml-stylesheet type="text/xsl" href="'.$logxslt.'"?>'.PHP_EOL, $content ); */
    
    echo $content;
    die();
}