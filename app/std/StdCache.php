<?php

//namespace StdCore/StdCache;

/**
 * Class StdCache
 * 
 * @package    StdCache
 * @copyright  Copyright (c) Url (fr) 2018
 * @since      12 decembre 2018
 * @author     Cylmat
 * @license    http://creativecommons.org/licenses/by/2.0/fr/ Creative Commons
 * 
 */

/**
 * Use
 * 
if(!StdCache::get('page')) 
{
    StdCache::start('page');
    //SCRIPT/////
    StdCache::end();
}
else StdCache::display();
 */

define('STDCACHE_DAY',86400);
define('STDCACHE_WEEK',604800);


class StdCache 
{
    static $__debug = FALSE;
    static $__delete = TRUE;
    
    /**
     * Data to store
     * 
     * @var string
     */
    private static $current_cache=NULL;
    
    /**
     * @var boolean
     */
    private static $active = TRUE;
    
    /**
     * duration
     */
    private static $duration = 3600; //1h default
    
    /**
     * ext
     */
    private static $file_ext = '.cache';
    
    /**
     * base path
     */
    private static $base_path=NULL;
    
    /**
     * subdirectory path (page, rss, etc...)
     */
    private static $sub_dir=NULL;
    
    /**
     * subdirectory 2 letters
     */
    private static $sub_filename=NULL;
    
    /**
     * Path from md5(url) 
     */
    private static $filename=NULL;
    
    /*
     * error msg
     */
    private static $error_msg='';
    
    /*
     * starting time
     * evite de supprimer les fichiers et repertoire trop longtemps (< 1sec)
     */
    private static $begin_time;
    
    /**
     * CONST
     */
    const DURATION_HOUR = 3600;   //3600 
    const DURATION_DAY  = 90000;  //3600 * 24 (86400) plus une heure pour varier;
    
    
    
    
    
    
                                /**   **   SET   **   **/
    
    /**
     * Set if active
     */
    static function config($base_path, $duration=NULL, $active=NULL)
    {
        self::setBasePath($base_path);
        
        if(!is_null($duration)) self::setDuration($duration);
        
        if(!is_null($active)) self::setActive($active);
    }
    
    /**
     * Set if active
     */
    static function setActive($active=TRUE)
    {
        self::$active = $active;
    }
    
    /**
     * Base path
     */
    static function setBasePath($base_path)
    {
        if(!is_string($base_path)) { self::error_msg('Base_path must be string'); return FALSE; }
        
        $base_path = preg_replace('#\/$#','',$base_path);
        self::$base_path = $base_path . '/';
    }
    
    /**
     * Duration
     */
    static function setDuration($duration)
    {
        if(!is_int($duration)) { self::error_msg('Duration must be integer'); return FALSE; }
        
        self::$duration = $duration;
    }
    
    
    
    
                                /**   **   GET   **   **/
    
    /**
     * Get current cache if exists
     */
    static function get($sub_dir)
    {
        //BASEPATH
        if(is_null(self::$base_path)) { self::error_msg('Base_path is null'); return FALSE; }
        
        self::_set_filename();
        
        // SUBDIR
        self::_set_subdir($sub_dir);
        
        //NO CACHE
        $c = self::_read_file();
        if( !$c ) return FALSE;

        self::$current_cache = $c;
        return self::$current_cache;
        //if( is_null(self::$current_cache) ) return FALSE;
    }
    
    /**
     * display cache
     */
    static function display()
    {
        //BASEPATH
        if(is_null(self::$base_path)) { self::error_msg('Base_path is null'); return FALSE; }
        
        echo self::$current_cache;
    }
    
    /**
     * Base path
     */
    static function getBasePath($base_path)
    {
        return self::$base_path;
    }
    
    
                             /**   **   FCT   **   **/
    
    /**
     * Start caching in directory $base_path . $dir
     * 
     * @param string $dir
     */
    static function start($sub_dir)
    {
        //BASEPATH
        if(is_null(self::$base_path)) { self::error_msg('Base_path is null'); return FALSE; }
        
        // SUBDIR
        self::_set_subdir($sub_dir);
        
        //FILENAME
        self::_set_filename();
        
        // START!!!
        ob_start();
        
        self::_make_dirs();
    }
    
    /**
     * Start
     */
    static function end()
    {
        //BASEPATH
        if(is_null(self::$base_path)) { self::error_msg('Base_path is null'); return FALSE; }
        
        $html = ob_get_contents();
        self::$current_cache = $html;
        
        // END!!!
        ob_end_flush();
        self::_write_file();
    }
    
    
    
    
    
    
    
    
    
    
    
                        /**   **   PRIVATE   **   **/
    
    /*
//[SCRIPT_URI] => https://check-url.inside-annuaire.com:443/ajax
//[QUERY_STRING] => url=https%3A%2F%2Fcheck-url.inside-annuaire.com%2Ftestlink&full=false&depth=false&level_depth=
//[REQUEST_URI] => /ajax?url=https%3A%2F%2Fcheck-url.inside-annuaire.com%2Ftestlink&full=false&depth=false&level_de=
    */
    static private function _set_filename()
    {
        $q = $_SERVER['QUERY_STRING'] ? '?' . $_SERVER['QUERY_STRING'] : '';
        
        $full_url = $_SERVER['SCRIPT_URI'] . $q;
        $full_url = urldecode($full_url);
        $full_url = urldecode($full_url);

        self::$filename = md5($full_url) . self::$file_ext;
        
        // ex betha.php ->   be/betha.php
        // ex alpha.log ->   al/alpha.log
        $sub_filename = substr(self::$filename, 0, 2) . '/';
        self::$sub_filename = $sub_filename;
    }
    
    /**
     * sub directory
     */
    static private function _set_subdir($sub_dir)
    {
        // SUBDIR
        if(!is_null($sub_dir)) 
        {
            $sub_dir = preg_replace('#\/$#','',$sub_dir);
            self::$sub_dir = $sub_dir . '/';
        }
    }
    
    /*
     * Create directories 
     */
    static private function _make_dirs()
    {
        //base
        if(!self::_mkdir(self::$base_path)) { self::error_msg('Cant create base_path'); return FALSE; }
        
        //SUBDIRECTORY 
        $sub_dir_path = self::$base_path . self::$sub_dir;
        if(!self::_mkdir($sub_dir_path)) { self::error_msg('Cant create sub_dir_path'); return FALSE; }
        
        //check FILENAME
        if(is_null(self::$filename)) { self::error_msg('Filename is null (make)'); return FALSE; }
        
        // SUBFILENAME  cree un sous-repertoire en fonction du fichier
        $sub_filename_path = $sub_dir_path . self::$sub_filename;
        
        //SUBFILE
        if(!self::_mkdir($sub_filename_path)) { self::error_msg('Cant create sub_filename_path'); return FALSE; }
        
        //Base + sub + sub_file created!
        return TRUE;
    }
    
    /*
     * write file cache
     */
    static private function _write_file()
    {
        //check FILENAME
        if(is_null(self::$filename)) { self::error_msg('Filename is null (write)'); return FALSE; }
        
        $final_path = self::$base_path . self::$sub_dir . self::$sub_filename;
        $filepath = $final_path . self::$filename;
        
        //CREATE FILE
        $file = new SplFileObject($filepath, 'w');
        $file->fwrite(self::$current_cache);
    }
    
    /*
     * read file cache
     */
    static private function _read_file()
    {
        //SUBDIRECTORY
        $sub_dir_path = self::$base_path . self::$sub_dir;
        
        self::_begin_time();
        
        //check FILENAME
        if(is_null(self::$filename)) { self::error_msg('Filename is null'); return FALSE; }
        
        // cree un sous-repertoire en fonction du fichier
        // ex betha.php ->   be/betha.php
        // ex alpha.log ->   al/alpha.log
        $sub_filename_path = $sub_dir_path . self::$sub_filename;
        
        
        //SUBFILE
        $filepath = $sub_filename_path . self::$filename;
        
        if(!file_exists($filepath)) return FALSE;

        //CREATE FILE
        $file = new SplFileObject($filepath, 'r');
self::__debug('readfile :'.$filepath );
        //get modification time
        $duration_passed = time() - $file->getMTime();

        if( $duration_passed > self::$duration) { self::__debug('Duration passed over!'); return FALSE; }
self::__debug('duration ok ('.$duration_passed.'sec)');
        //content size
        if( $file->getSize() < 1 ) { self::__debug('No file content (size0)'); return FALSE; }

        //Supprimer les fichiers de répertoire uniquement si file content 
        //evite de prendre du temps CPU si fichier en ecriture
        if ($c = $file->fread( $file->getSize() )) {
            
            //REMOVE OLDER FILES
            self::remove_shuffled_dir_files($sub_dir_path);
self::__debug('get content ok ('.$duration_passed.'sec)');
            return $c;
        }
        
        self::error_msg('Cant read file content'); 
        return FALSE;
    }
    
    /**
     * Create a directory
     * 
     * @param type $dir
     * @return boolean
     */
    static private function _mkdir($dir)
    {
        if(!is_dir($dir)) 
            if(mkdir($dir)) 
                return TRUE;
            
        if(is_dir($dir)) return TRUE;
            
        self::error_msg('Cant mkdir $dir'); return FALSE;
    }
    
    
    /**
     * Selectionne les sous-repertoires de ex: 'page/'
     * page/ ab/
     * page/ vd/
     * page/ be/
     *       etc..
     * 
     * les mélanges et appel _remove_old_dir_files() pour chaque
     */
    private static function remove_shuffled_dir_files($subdir_path) 
    {
        $i = new DirectoryIterator($subdir_path);

        $subdir_list = [];
        foreach($i as $subdir)
        {
            if(!$subdir->isDot() && $subdir->isDir()) 
                $subdir_list[] = $subdir->getRealPath();
        }
        shuffle($subdir_list);

        // ab/
        // fg/
        // ef/ ....
        foreach($subdir_list as $subdir)
        {
            if(self::_out_time()) return;
            
            self::_remove_old_dir_files($subdir);
        }
    }
    
    
    private static function _remove_old_dir_files($dir_path) 
    {
        //$DAY = 86400;
        //$WEEK = 604800;
        //$DEBUG = FALSE;
        $duration = self::$duration; //$DAY * $time_older_days
        
        //ACCELERE LE PROCESS 9*sur10
        //if(rand(0,3)) return;
        self::__debug ('RD-Processing remove files' );

        //le repertoire est vide (il reste des fichiers)
        $stay_file_or_dir = FALSE; 

        // Open the source directory to read in files
        $i = new DirectoryIterator($dir_path);

        foreach($i as $f) 
        {
            //VARIE LES FICHIERS A SUPPRIMER
            //if(rand(0,1)) continue;
            if(self::_out_time()) return FALSE;
            
            // FILE
            if($f->isFile()) 
            {
                //duration over
                $d = time() - $f->getMTime();
                if ($d > $duration) { 
                    if(self::$__delete) 
                        if(!unlink($f->getRealPath()))
                            self::error_msg('RD-Cant unlink '.$f->getRealPath());
                    
                    self::__debug ('RD-Remove older file ('.  number_format($d/60/24, 2).' day) '.$f->getRealPath() );
                }
                
                //still ok
                else {
                    self::__debug( 'RD-Keep ('.  number_format($d/60/24, 2).' day) '.$f->getRealPath() );
                    $stay_file_or_dir = TRUE;
                }
            } 
            //DIRECTORY or DOT
            elseif(!$f->isDot() && $f->isDir()) 
            {
                if( !self::_remove_old_dir_files( $f->getRealPath() ) ) 
                {
                    self::__debug('RD-File still exists in '.$f->getRealPath() );
                    $stay_file_or_dir = TRUE;
                }
            }
        }

        //NO FILES LEFT
        if(!$stay_file_or_dir) 
        {
            self::__debug('RD-Removing '.$dir_path);
            if(self::$__delete) 
                if(!rmdir($dir_path)) { self::error_msg('RD-Cant rmdir '.$dir_path); return FALSE; }
                else return TRUE;
        }
        else { self::__debug('RD-Keep no-empty directory '.$dir_path); }

        return FALSE;
    }
    
    
    
    private static function _begin_time() { self::$begin_time = microtime(true)*10000; }
    private static function _out_time() { $m = microtime(true)*10000; if($m - self::$begin_time >= 800) return TRUE; return FALSE; //500: 1/2 seconde
    }
    
                                /**   **   DEBUG   **   **/
    
    static function __debug($t,$e=NULL)
    {
        if(!self::$__debug) return;
        
        print '<pre>';
        print_r($t);
        print '</pre>';
        
        if(!is_null($e)) print $e;
    }
    
    static function error_msg($msg) { self::$error_msg .= 'ERR: '.$msg . '<br/>' . PHP_EOL; }
    
    static function get_error_msg() { return self::$error_msg; }
    
    static function display_error_msg() { echo self::$error_msg; }
    
}


