<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
header('Content-Type: text/xml');

$logxml = __DIR__ . '/logfile.xml';
$xslt = __DIR__ . '/logfile.xslt';

if( file_exists($logxml) && file_exists($xslt) )
{
    $content = file_get_contents($logxml);
    
    $content = preg_replace( '/<\?xml.?version="1.0".?encoding="UTF-8".?\?>/', '<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL.
                                '<?xml-stylesheet type="text/xsl" href="logfile.xslt"?>'.PHP_EOL, $content );
    
    echo $content;
    die();
}