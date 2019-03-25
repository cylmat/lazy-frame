<?php

$STD_CORE_PATH = realpath(dirname(__FILE__)) . '/';

/**
 * String Type argument
 * 
 * @param type $arg
 * @throws Exception
 */
function stringtype($arg, $num='') 
{ 
    if(NULL===$arg) return;
    $b = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
    
    if(!is_string($arg)) user_error (
        'Argument '.$num.' passed to '.$b[1]['class'].'::'.$b[1]['function'].'() must be of the type string, '.gettype($arg).' given, ' .PHP_EOL.
        'called in '.$b[1]['file'].' on line '.$b[1]['line'].', ' .PHP_EOL.
        'and defined in '.$b[0]['file'].' on line '.$b[0]['line'], E_USER_WARNING );
}

function integertype($arg, $num='') 
{ 
    if(NULL===$arg) return;
    $b = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
    
    if(!is_integer($arg)) user_error (
        'Argument '.$num.' passed to '.$b[1]['class'].'::'.$b[1]['function'].'() must be of the type integer, '.gettype($arg).' given, ' .PHP_EOL.
        'called in '.$b[1]['file'].' on line '.$b[1]['line'].', ' .PHP_EOL.
        'and defined in '.$b[0]['file'].' on line '.$b[0]['line'] , E_USER_WARNING );
}

function booleantype($arg, $num='') 
{ 
    if(NULL===$arg) return;
    $b = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
    
    if(!is_bool($arg)) user_error (
        'Argument '.$num.' passed to '.$b[1]['class'].'::'.$b[1]['function'].'() must be of the type boolean, '.gettype($arg).' given, ' .PHP_EOL.
        'called in '.$b[1]['file'].' on line '.$b[1]['line'].', ' .PHP_EOL.
        'and defined in '.$b[0]['file'].' on line '.$b[0]['line'] , E_USER_WARNING );
}
/*
 * Warning: dir(/): failed to open dir: Permission denied in /home/insideantx/www_url/application/core/SeasLog.php on line 819
Notice: Trying to get property of non-object in /home/insideantx/www_url/application/core/SeasLog.php on line 822
 * Notice: Array to string conversion in /home/insideantx/www_url/application/core/SeasLog.php on line 950
 */

function pprint($a,$ext='') { echo '<pre>'; print_r($a); echo '</pre>', $ext . '<br/>' . PHP_EOL; }
function pdump($a,$ext='') { echo '<pre>'; var_dump($a); echo '</pre>', $ext . '<br/>' . PHP_EOL; }

/**
 * DIRECTORY Class
 */
class StdDir {
    
    /**
     * Supprimer tous les fichiers et répertoires > $time_older
     * 
     * @param string $dir_path
     * @param integer $time_older (timestamp)
     * @return boolean
     */
    static function removeOlders($dir_path, $time_older) 
    {
        if(!is_string($dir_path)) {throw new Exception('Param @dir_path must be a string '.PHP_EOL); return FALSE;}
        if(!is_integer($time_older)) {throw new Exception('Param @time_older must be an integer '.PHP_EOL); return FALSE;}
        
        //le repertoire est vide (il reste des fichiers)
        $stay_file_or_dir = FALSE; 

         //Open the source directory to read in files
        $i = new DirectoryIterator($dir_path);
        foreach($i as $f) 
        {
            if($f->isFile()) 
                if (time() - $f->getMTime() >= $time_older)  
                    unlink($f->getRealPath());
                else 
                    $stay_file_or_dir = TRUE;
            elseif(!$f->isDot() && $f->isDir()) 
                if( !self::removeOlders( $f->getRealPath(), $time_older ) ) {
                    $stay_file_or_dir = TRUE;
            }
        }

        //il ne reste plus aucun fichier ni repertoire
        if(!$stay_file_or_dir) {
                if(rmdir($dir_path)) return TRUE;
                else return FALSE;
        }
        return FALSE;
    }
    
    
    function delTree($dir) {
        $files = array_diff(scandir($dir), array('.','..'));
         foreach ($files as $file) {
           (is_dir("$dir/$file")) ? $this->delTree("$dir/$file") : unlink("$dir/$file");
         }
         return rmdir($dir);
    } 
    
    
    
    /**
     * Get all files recursively
     * Only filenames, or fully path
     * 
     * @param string $dir_path
     * @param boolean $true_path
     * @return boolean
     */
    static private $scanned_files_list=[];
    
    /*static function getRFiles($dir_path, $true_path=TRUE) 
    {
        if(!is_string($dir_path)) {throw new Exception('Param @dir_path must be a string '.PHP_EOL); return FALSE;}
        if(!is_bool($true_path)) {throw new Exception('Param @true_path must be a boolean '.PHP_EOL); return FALSE;}
        
        // directory
        $d = dir($dir_path);

        //accept dir/ OR dir
        if(!$dir = new DirectoryIterator( $d->path )) return FALSE;

        foreach($dir as $file)
        {
            if (!$file->isDot() && $file->isDir()) 
                self::getRFiles($dir_path, $true_path);
            elseif( $file->isFile() )
                if(!$true_path)
                    self::$scanned_files_list[] = $file->getFilename();
                else
                    self::$scanned_files_list[] = $file->getRealPath();
        }
        $s = self::$scanned_files_list;
        
        return self::$scanned_files_list;
    }*/
}




require_once $STD_CORE_PATH . 'StdTest.php';
require_once $STD_CORE_PATH . 'StdMock.php';
require_once $STD_CORE_PATH . 'StdLog.php';

require_once $STD_CORE_PATH . 'StdArray.php';
require_once $STD_CORE_PATH . 'StdCache.php';
require_once $STD_CORE_PATH . 'StdForm.php';
require_once $STD_CORE_PATH . 'StdString.php';
require_once $STD_CORE_PATH . 'StdTable.php';
require_once $STD_CORE_PATH . 'StdUrl.php';

//use FluentUrl; //use PHPUnit\Framework\TestCase;