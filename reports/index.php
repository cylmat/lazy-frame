<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function get_content($file)
{
    if(!file_exists($file)) return '';
    
    $ret = '';
    $f = file_get_contents($file);
    $e = explode("\n", $f);
    foreach($e as $l => $line)
    {
        $line = preg_replace('/<\?xml.*?>/','',$line);
        $ret .= htmlentities($line).'<br/>'.PHP_EOL;
    }
    return $ret;
}

echo '<html><body>
    
<fieldset><legend>Php CS</legend>' .
    get_content('var/php_reports/phpcs_report.xml') .
'</fieldset>
    
<fieldset><legend>Php MD</legend>' .
    get_content('var/php_reports/phpmd_report.xml') .
'</fieldset>
    
<fieldset><legend>Php Unit</legend>' .
    get_content('var/php_reports/phpunit_report.xml') .
'</fieldset>

<fieldset><legend>Style Lint</legend>' .
    get_content('var/css_reports/stylelint.txt') .
'</fieldset>
    
<fieldset><legend>Js Hint</legend>' .
    get_content('var/js_reports/jshint.txt') .
'</fieldset>
    
<fieldset><legend>Jest</legend>' .
    get_content('var/js_reports/jest.xml') .
'</fieldset>




</body></html>';