<?php 

//namespace SeasLog;

/*
     * user_error($msg, E_USER_NOTICE | E_USER_DEPRECATED | E_USER_WARNING | E_USER_ERROR).
     * 
     * error_log("Grosse bourde !", 3, "/var/tmp/mes-erreurs.log");
     *       rawurlencode() ou addslashes() avant d'appeler la fonction error_log(). 
     */

/**
 * Class StdLog
 */
defined('STDLOG_ERROR_ACTIVE') OR define('STDLOG_ERROR_ACTIVE',0);
class StdLog extends SeasLog {  }


/**
 * HELPERS ADDED
 * active, basePath, requestId, logger, template, dateTimeFormat, level
 */
function stdlog_setParams(array $params) {
    if(!empty($params['active'])) StdLog::setActive($params['active']);
    if(!empty($params['basePath'])) StdLog::setBasePath($params['basePath']);
    if(!empty($params['requestId'])) StdLog::setRequestId($params['requestId']);
    if(!empty($params['logger'])) StdLog::setLogger($params['logger']);
    if(!empty($params['template'])) StdLog::setTemplate($params['template']);
    if(!empty($params['dateTimeFormat'])) StdLog::setDatetimeFormat($params['dateTimeFormat']);
    if(!empty($params['level'])) StdLog::setLevel($params['level']);
} 

/**
 * LOG HELPERS
 */
function stdlog_log ($level, $message, $content=[], $logger=NULL){ StdLog::log ( $level, $message, $content, $logger ); }
function stdlog_info ($message, $content=[], $logger=NULL)       { StdLog::info ( $message, $content, $logger ); }
function stdlog_notice ($message, $content=[], $logger=NULL)     { if(STDLOG_ERROR_ACTIVE) user_error($message, E_USER_NOTICE); 
                                                                    StdLog::notice ( $message, $content, $logger ); }
function stdlog_debug ($message, $content=[], $logger=NULL)      { StdLog::debug ( $message, $content, $logger ); }
function stdlog_warning ($message, $content=[], $logger=NULL)    { if(STDLOG_ERROR_ACTIVE) user_error($message, E_USER_WARNING); 
                                                                    StdLog::warning ( $message, $content, $logger ); }
function stdlog_error ($message, $content=[], $logger=NULL)      { if(STDLOG_ERROR_ACTIVE) user_error($message, E_USER_ERROR); 
                                                                    StdLog::error ( $message, $content, $logger ); }
function stdlog_alert ($message, $content=[], $logger=NULL)      { StdLog::alert ( $message, $content, $logger ); }
function stdlog_emergency ($message, $content=[], $logger=NULL)  { StdLog::emergency ( $message, $content, $logger ); }
function stdlog_critical ($message, $content=[], $logger=NULL)   { StdLog::critical ( $message, $content, $logger ); }

function stdlog_getBuffer ($logger=NULL, $level=NULL)   { StdLog::getBuffer ($logger, $level); }


/*******************************************
 * 
 * TODO
 * - put SeasLog::setDisplay() in Stdlog class
 * - class StdLog extends SeasLog { public static $filename_prefix = "stdlog-"; }
 * 
 */












    
/********************************************************************************
 * 
 *                              SEASLOG CLASS AND METHODS
 * 
 */
defined('SEASLOG_ALL') OR define('SEASLOG_ALL', "ALL");
//"INFO" - Interesting events.Emphasizes the running process of the application. 
defined('SEASLOG_INFO') OR define('SEASLOG_INFO', "INFO"); 
//"NOTICE" - Normal but significant events.Information that is more important than the INFO level during execution. 
defined('SEASLOG_NOTICE') OR define('SEASLOG_NOTICE', "NOTICE"); 
//"DEBUG" - Detailed debug information.Fine-grained information events.
defined('SEASLOG_DEBUG') OR define('SEASLOG_DEBUG', "DEBUG");
//"WARNING" - Exceptional occurrences that are not errors.Potentially aberrant information that needs attention and needs to be repaired. 
defined('SEASLOG_WARNING') OR define('SEASLOG_WARNING', "WARNING");
//"ERROR" - Runtime errors that do not require immediate action but should typically. 
defined('SEASLOG_ERROR') OR define('SEASLOG_ERROR', "ERROR");
//"ALERT" - Action must be taken immediately.Immediate attention should be given to relevant personnel for emergency repairs. 
defined('SEASLOG_ALERT') OR define('SEASLOG_ALERT', "ALERT");
//"EMERGENCY" - System is unusable.
defined('SEASLOG_EMERGENCY') OR define('SEASLOG_EMERGENCY', "EMERGENCY"); //unusable
//"CRITICAL" - Critical conditions.Need to be repaired immediately, and the program component is unavailable. 
defined('SEASLOG_CRITICAL') OR define('SEASLOG_CRITICAL', "CRITICAL");

defined('SEASLOG_DETAIL_ORDER_ASC') OR define('SEASLOG_DETAIL_ORDER_ASC', 1); //for analyser details
defined('SEASLOG_DETAIL_ORDER_DESC') OR define('SEASLOG_DETAIL_ORDER_DESC', 2);

defined('SEASLOG_APPENDER_FILE') OR define('SEASLOG_APPENDER_FILE', 1);
defined('SEASLOG_APPENDER_TCP') OR define('SEASLOG_APPENDER_TCP', 2);
defined('SEASLOG_APPENDER_UDP') OR define('SEASLOG_APPENDER_UDP', 3);



/**
 * Class SeasLog
 */
class SeasLog { 
    
    /**
     * Constant
     */
    static private $INDEX = 'SEASLOG';
    
    /**
     * used in analyzerCount()
     * @var type 
     */
    //0-EMERGENCY 1-ALERT 2-CRITICAL 3-ERROR 4-WARNING 5-NOTICE 6-INFO 7-DEBUG 8-ALL     Default 8 (All of them)
    static private $DEFINED_LEVELS = [SEASLOG_INFO, SEASLOG_NOTICE, SEASLOG_DEBUG, SEASLOG_WARNING, 
                                      SEASLOG_ERROR, SEASLOG_ALERT, SEASLOG_EMERGENCY, SEASLOG_CRITICAL];
        
    /**
     * used in setActive()
     * @var type 
     */
    static private $DISPLAY = [
        'INFO' => TRUE, 'NOTICE' => TRUE, 'DEBUG' => TRUE, 'WARNING' => TRUE,
        'ERROR' => TRUE, 'ALERT' => TRUE, 'EMERGENCY' => TRUE, 'CRITICAL' => TRUE
    ];
    
    
    /**
     * @var bool
     */
    static private $active=TRUE;
    
    
    /**
     * @var string
     */
    private static $base_path = NULL;
    
    /**
     * @var string
     */
    private static $request_id = NULL;
    
    /**
     * @var string
     */
    private static $lastLogger = 'default';
    
    /**
     * @var string
     * @require %T %L
     */
    private static $template = "%T | %L | %Q | %t | %M"; //DateTime Level ProcessId Message

    /**
     * @var string
     */
    private static $dateTime_format = "Y-m-d H:i:s";
    
    /**
     * @var string
     */
    private static $level = 8; //ALL
    
    
    /**
     * ADDED TO ORIGINAL CLASS
     */
    public static $filename_prefix = "stdlog-"; 
    public static $filedate_format = "Y-m-d"; //used for filename
    public static $filename_ext = ".php"; //used for filename
    
    
    
    
    
                                        /*  *  SET  *  */
    
    /**
     * @param string $base_path
     * 
     * @return boolean
     */
    public static function setBasePath($base_path=NULL) 
    { 
        stringtype($base_path);
        if(is_null($base_path)) 
            { self::$base_path = NULL; return TRUE; }

        self::$base_path = preg_replace('#\/$#','',$base_path) . '/'; 
        return TRUE;
    }
    
    /**
     * @param string $base_path
     * 
     * @return boolean
     */
    public static function setActive($active=TRUE) 
    { 
        self::$active = $active; 
        return TRUE;
    }
    
    /**
     * @param string $request_id
     * 
     * @return bool
     */
    public static function setRequestId ( $request_id )
    {
        stringtype($request_id);
        
        self::$request_id = $request_id;
        return TRUE;
    }
    
    /**
     * @param string $logger
     * 
     * @return bool
     */
    public static function setLogger ( $logger )
    {
        stringtype($logger);
        
        self::$lastLogger = $logger;
        return TRUE;
    }
    
    
    
    /**
     * 
     * @param string $template
     * 
     * @return boolean
     */
    public static function setTemplate( $template )
    {
        stringtype($template);
        
        //time and level
        if( (!preg_match('#%T#', $template)) || (!preg_match('#%L#', $template)) ) { 
            return FALSE;
        }
        
        self::$template = $template;
        return TRUE;
        
    }
    
    /**
     * @param string $newDatetime
     * 
     * @return bool
     */
    public static function setDatetimeFormat ( $format )
    {
        stringtype($format);
        
        self::$dateTime_format = $format;
        return TRUE;
    }
    
    /**
     * @param integer $level
     * 
     * @return bool
     */
    public static function setLevel ( $level=8 )
    {
        integertype($level);
        
        //SET TO DEFAULT
        self::setDisplay ( );
        
        self::$level = $level;
        return TRUE;
    }
    
    
    /**
     * @param array $not_displayed
     * 
     * @use :
     * ex: $displayed = [ info=>false, notice=>buffer, warning=>true ]
     */
    public static function setDisplay(array $displayed=NULL)
    {
        //SET TO DEFAULT
        self::$level = 8;
        
        foreach(self::$DISPLAY as $item => $v)
            {
                $i = strtoupper($item);
                self::$DISPLAY[$i] = TRUE;
            }
            
        if(NULL === $displayed)
            return TRUE;
        
        foreach($displayed as $item => $v)
        {
            if(!is_bool($v) && 'buffer'!==$v) continue;
            
            $i = strtoupper($item);
            //$i = preg_replace('/^DISPLAY_/','',$item);
            //$i = 'DISPLAY_'.$item;
            
            //if(property_exists($this,$i))
            if(isset(self::$DISPLAY[$i]))
                self::$DISPLAY[$i] = $v;
        }
        return TRUE;
    }
    
    
    
    
                                    /*  *  GET  *  */
    
    
    public static function getBasePath() 
    { 
        return self::$base_path; 
    }
    
    public static function getActive() 
    { 
        return self::$active; 
    }
    
    /**
     * @param string $logger
     * @param string $level
     * 
     * @return type
     */
    public static function getBuffer($logger=NULL, $level=NULL) 
    { 
        stringtype($logger);
        stringtype($level);
        
        $G_index = $GLOBALS[self::$INDEX];
        
        //logger
        if(!is_null($logger))
            if(isset($G_index[$logger]))
                $G_index = $G_index[$logger];
            else return FALSE;
        
        //level
        $r = [];
        if(!is_null($level))
            foreach($G_index as $n => $value)
            {
                $reg = '/'.$level.'/';
                if(preg_match($reg, $value))
                    $r[] = $value;
            }
        else
            $r = $G_index;

        return $r;
    }
    
    
    /**
     * @param string $logger
     * @param string $level
     * 
     * @return type
     */
    public static function getDisplay() 
    { 
        return self::$DISPLAY;
    }
    
    /**
     * 
     * @return string
     */
    public static function getRequestId ()
    {
        return self::$request_id;
    }
    
    /**
     * 
     * @return string
     */
    public static function getTemplate ()
    {
        return self::$template;
    }
    
    
    /**
     * @return string
     */
    public static function getLastLogger( )
    {
        return self::$lastLogger;
    }
    
    /**
     * 
     * @return bool
     */
    public static function getDatetimeFormat ( )
    {
        return self::$dateTime_format;
    }
    
    
    /**
     * @param integer $level
     * 
     * @return bool
     */
    public static function getLevel ( )
    {
        return self::$level;
    }
    
    
    
    
    
    
                                                    /*  *  FCT  *  */
    
    
    /**
     * @param string $message 
     * @param array  $content 
     * @param string $logger
     * 
     * @return bool
     */
    public static function alert ( $message, array $content=[], $logger=NULL )
    {
        return self::log( SEASLOG_ALERT, $message, $content, $logger );
    }
    
    /**
     * @param string $level 
     * @param string $log_path 
     * @param string $key_word 
     * @param int $start 
     * @param int $limit 
     * @param int $order
     * 
     * @return string|integer
     */
    //SeasLog::analyzerDetail(SEASLOG_ERROR,'test/logger/','neeke',1,2);
    public static function analyzerDetail ( $level=SEASLOG_ALL, $log_path=NULL, $key_word=NULL, $start=1, $limit=20, $order=SEASLOG_DETAIL_ORDER_ASC )
    {
        stringtype($level, 1); stringtype($log_path, 2); stringtype($key_word, 3); integertype($start, 4); integertype($limit, 5); integertype($order, 6);
        
        $logs = FALSE;
        if($start<1) { user_error("Param @start can't be negative or null", E_USER_NOTICE); $start=1; }
        if($limit<1) { user_error("Param @limit can't be negative or null", E_USER_NOTICE); $limit=20; }
        
        //logger
        if(is_null($log_path)) $log_path = self::$lastLogger;

        // initialisation
        $index=0; $count=0; $G_return = [];
        $reg_level = '#'.$level.'#';
        $reg_keyword = '#'.$key_word.'#';

        //
        // Get infos from FILES
        //
        if(!is_null(self::$base_path)) 
        {
            //if(!self::_scan_readdir($log_path, $order)) return FALSE;
            //if(!__SeasLog_read::scandir($log_path, $order)) return FALSE;

            do { //boucle
                if(!$logs = self::nextfile($log_path, $order)) break;

                //recupere chaque ligne
                foreach($logs as $logged_message) {
                    
                    //se place sur l'index
                    if(++$index < $start) continue;
                    
                    //LEVEL
                    if(SEASLOG_ALL !== $level)
                        if( !preg_match($reg_level, $logged_message) ) 
                                continue;

                    //KEYWORD
                    if(!is_null($key_word))
                        if( !preg_match($reg_keyword, $logged_message) ) 
                                continue;
                    
                    //evite de dépasser Limit
                    //si resultat ou nombre de ligne > limite
                    if(sizeof($G_return) >= $limit || $count++ >= $limit) break;
                    
                    $G_return[] = $logged_message;
                }
            } //end do
            while (sizeof($G_return) < $limit && $count < $limit);
            
            if(SEASLOG_DETAIL_ORDER_DESC !== $order)
                $G_return = array_reverse($G_return);

            return $G_return;
        }
        
        //
        // ELSE get infos from $GLOBALS
        //
        if(isset($GLOBALS[self::$INDEX][$log_path]))
            $logs = $GLOBALS[self::$INDEX][$log_path];
        else return FALSE;

        //no results
        if(empty($logs) || sizeof($logs)<1 || !is_array($logs)) return NULL;

        //if count set
        foreach($logs as $logged_message)
        {
            if(++$index < $start) continue;
            
            //LEVEL
            if(SEASLOG_ALL !== $level)
                if( !preg_match($reg_level, $logged_message) ) continue;
            
            //KEYWORD
            if(!is_null($key_word))
                if( !preg_match($reg_keyword, $logged_message) ) continue;
            
            if($count++ >= $limit) break;
            
            //APPEND MESSAGE
            $G_return[] = $logged_message;
        }

        if(SEASLOG_DETAIL_ORDER_DESC == $order) $G_return=array_reverse($G_return);
        return $G_return; 
    }
    
    /**
     * @param string $level
     * @param string $log_path
     * @param string $key_word
     * 
     * @return array|int
     */ 
    public static function analyzerCount ( $level=SEASLOG_ALL, $log_path=NULL, $key_word=NULL )
    {
        integertype($level); stringtype($log_path); stringtype($key_word); 
        
        $G = self::analyzerDetail($level, $log_path, $key_word);
        
        if(!is_array($G) || empty($G)) return NULL;
        if(sizeof($G)<1) return NULL;
        
        //LEVEL uniq
        if(SEASLOG_ALL !== $level)
        {
            return sizeof($G);
        }
        
        //ALL LEVELS
        
        $G_return=[];
        foreach($G as $n => $logged_message)
        {
            foreach(self::$DEFINED_LEVELS as $level)
            {
                $reg = '#'.$level.'#';
                if( preg_match($reg, $logged_message) ) 
                    if( !isset($G_return[$level]) )
                        $G_return[$level] = 1;
                    else
                        $G_return[$level]++;
            }
        }
        return $G_return;
    }
    
    /**
     * @param string $message 
     * @param array $content 
     * @param string $logger
     * 
     * @return bool
     */
    public static function critical ( $message, array $content=[], $logger=NULL )
    {
        return self::log( SEASLOG_CRITICAL, $message, $content, $logger );
    }
    
    /**
     * @param string $message 
     * @param array $content 
     * @param string $logger
     * 
     * @return bool
     */
    public static function debug ( $message, array $content=[], $logger=NULL )
    {
        return self::log( SEASLOG_DEBUG, $message, $content, $logger );
    }
    
    /**
     * @param string $message 
     * @param array $content 
     * @param string $logger
     * 
     * @return bool
     */
    public static function emergency ( $message, array $content=[], $logger=NULL )
    {
        return self::log( SEASLOG_EMERGENCY, $message, $content, $logger );
    }
    
    /**
     * @param string $message 
     * @param array $content 
     * @param string $logger
     * 
     * @return bool
     */
    public static function error ( $message, array $content=[], $logger=NULL )
    {
        return self::log( SEASLOG_ERROR, $message, $content, $logger );
    }
    
    /**
     * 
     */
    public static function flushBuffer() 
    { 
        $GLOBALS[self::$INDEX] = []; 
    }
     
    
    /**
     * @param string $message 
     * @param array $content 
     * @param string $logger
     * 
     */
    public static function info ( $message, array $content=[], $logger=NULL )
    {
        return self::log( SEASLOG_INFO, $message, $content, $logger );
    }
    
    /**
     * @param string $level 
     * @param string $message
     * @param array $content 
     * @param string $logger
     * 
     * @return bool
     */
    public static function log ( $level, $message, array $content=[], $logger=NULL )
    {
        //CHECK ACTIVE LEVEL
        //if ACTIVE == FALSE
        if(FALSE === self::$DISPLAY[$level]) return;
        
        // REQUIRE
        //if(is_null(self::$base_path)) 
            //{ throw new Exception('SeasLog::$base_path needs to be defined!'); return FALSE; }
        if( !isset($GLOBALS[self::$INDEX]) )
            self::flushBuffer ();
        
        // continue
        if(is_null($logger)) $logger = self::$lastLogger;
        
        //backtrace
        $backtrace = self::_backtrace();
        
        //check if logger is set
        if(!isset( $GLOBALS[self::$INDEX][$logger] )) 
            $GLOBALS[self::$INDEX][$logger] = [];
            
        $G = &$GLOBALS[self::$INDEX][$logger];
        
        $L = $level;
        
        //info log {NAME} array('NAME' => 'neeke')
        $M=$message;
        foreach($content as $item => $val)
        {
            //$M = strtr($message, $content);
            $regex = '#\{'.$item.'\}#';
            $M = preg_replace($regex,$val,$M);
        }
        
        $T = date(self::$dateTime_format);
        
        $t = time();
        
        $Q = uniqid();
        
        $H = '';
        if(isset($_SERVER['HTTP_HOST'])) $H=$_SERVER['HTTP_HOST'];
        
        $P = '';
        $D = '';
        $R = '';
        if(isset($_SERVER['REQUEST_URI'])) $H=$_SERVER['REQUEST_URI'];
        
        $m = '';
        
        $I = '';
        if(isset($_SERVER['REMOTE_ADDR'])) $I=$_SERVER['REMOTE_ADDR'];
        if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])) $I=$_SERVER['HTTP_X_FORWARDED_FOR'];
        if(isset($_SERVER['HTTP_X_REAL_IP'])) $I=$_SERVER['HTTP_X_REAL_IP'];
        
        $F = ''; //Filename:line
        if($backtrace)
        {
            $file = explode('/',$backtrace['file']);
            $file = end($file);
            $F = $file.':'.$backtrace['line'];
        }
        
        $U = memory_get_usage();
        $u = memory_get_peak_usage();
        
        $C = '';
        if($backtrace)
            $C = $backtrace['class'].'->'.$backtrace['function'].'()';
        
        $l = $logger;
        
        // write
        $trans = array(
            '%L'=>$L,   '%level'=>$L,   //Level.
            '%M'=>$M, 	'%message'=>$M,//Message.
            '%T'=>$T, 	'%datetime'=>$T,//DateTime. 
            '%t'=>$t, 	'%timestamp'=>$t,//Timestamp. 
            '%Q'=>$Q, 	'%requestid'=>$Q,//RequestId.  
            '%H'=>$H, 	'%hostname'=>$H,//HostName.
            '%P'=>$P, 	'%processid'=>$P,//ProcessId.
            '%D'=>$D, 	'%domain'=>$D,//Domain:Port. Such as`www.cloudwise.com:80`; When Cli, Such as `cli`.
            '%R'=>$R, 	'%request'=>$R,//Request URI. Such as`/app/user/signin`; When Cli it's the index script, Such as `CliIndex.php`.
            '%m'=>$m, 	'%method'=>$m,//Request Method. Such as`Get`; When Cli it's the command script, Such as `/bin/bash`.
            '%I'=>$I, 	'%clientip'=>$I, //Client IP; When Cli it's `local`. Priority value: HTTP_X_REAL_IP > HTTP_X_FORWARDED_FOR > REMOTE_ADDR
            '%F'=>$F, 	'%filename'=>$F,//FileName:LineNo. Such as `UserService.php:118`.
            '%U'=>$U, 	'%usage'=>$U,//MemoryUsage.
            '%u'=>$u, 	'%peak'=>$u,//PeakMemoryUsage. 
            '%C'=>$C, 	'%class'=>$C,//`TODO` Class::Action. Such as `UserService::getUserInfo`
            '%l'=>$l,   '%logger'=>$l//logger
        );
        
        // REQUIRE
        if(!preg_match('/\%(T|datetime)/',self::$template)) { self::$template .= ' (add:%T) '; }
        if(!preg_match('/\%(L|level)/',self::$template)) { self::$template .= ' (add:%L) '; }
        
        $append = strtr(self::$template, $trans);
        
        //valid message
        if(!is_string($append) || strlen($append)<1) 
            $append = " - MESSAGE NOT VALID ! - "; 
        
        if(!isset($G) || empty($G)) 
            //BASEPATH
            if(is_null(self::$base_path)) $G=[0=>'Logs by SeasLog ( Base_path not defined ) '];
            else $G=[0=>'Logs by SeasLog '];
        
        
        // add content VALID
        //if ACTIVE == 'buffer'
        if('buffer' === self::$DISPLAY[$level]) 
            if( $G[] = $append ) return TRUE;
            else return FALSE;
            
        //IF ACTIVE == TRUE
        if( $G[] = $append ) 
            //write in log dir
            if(self::write( date(self::$filedate_format), $logger, $append) ) 
                //is ok
                return TRUE;
        
        return FALSE;
    }
    
    
    /**
     * @param string $message 
     * @param array $content 
     * @param string $logger
     */
    public static function notice ( $message, array $content=[], $logger=NULL )
    {
        return self::log( SEASLOG_NOTICE, $message, $content, $logger );
    }
    
     
    
    /**
     * @param string $message 
     * @param array $content 
     * @param string $logger
     */
    public static function warning ( $message, array $content=[], $logger=NULL )
    {
        return self::log( SEASLOG_WARNING, $message, $content, $logger );
    }
    
    
    
    
    
                                            /*  *  PRIVATE  *  */
    
    /**
     * 
     * @return array|false
     */
    private static function _backtrace()
    {
        $backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
        
        //passe ce fichier SeasLog.php
        array_shift($backtrace); 

        //encore soi-même (fonction appelée de SeasLog)
        $r = '#'.__FILE__.'#';
        if(isset($backtrace[0]['file']))
            if( preg_match($r, $backtrace[0]['file']) ) 
                array_shift($backtrace);
            
        if(isset($backtrace[0]['file']))
            if( preg_match($r, $backtrace[0]['file']) ) 
                array_shift($backtrace);
            
        //use of Helpers
        if(isset($backtrace[0]['file']))
            if( preg_match($r, $backtrace[0]['file']) ) 
                array_shift($backtrace);
    
        $backtrace_return = ['file'=>'', 'line'=>'', 'function'=>'', 'class'=>''];
         
        // function de définition $backtrace[0]
        if( isset($backtrace[0]['file']) && isset($backtrace[0]['line']) && isset($backtrace[0]['function']) )
        {
            $backtrace_return['file'] = $backtrace[0]['file'];
            $backtrace_return['line'] = $backtrace[0]['line'];
        }
        else return FALSE;
        
        // function appelante $backtrace[1]
        if( isset($backtrace[1]['function']) && isset($backtrace[1]['class']) )
        {
            $backtrace_return['function'] = $backtrace[1]['function'];
            $backtrace_return['class'] = $backtrace[1]['class'];
        }
        else return FALSE;

        return $backtrace_return;
    }
    
    




    
    
    


/*************************************************************
 * 
 *                      Class SeasLog::write
 * 
 ************************************************************/

    
    /**
     * 
     * @param string $date_filename
     * @param string $logger
     * @param string $append_data
     * 
     * @return boolean
     * 
     * ex: /var/log/www/tmp_logger/20180707.log
     * //if(error_log($new_content, 3, $filename))
     */
    protected static function write($date_filename, $logger, $append_data)
    {
        stringtype($date_filename); stringtype($logger); stringtype($append_data);
        
        if( !$dlogger_path = self::_valid_dir($logger) ) return FALSE;
        

        // filename
        $filename = $dlogger_path . self::$filename_prefix . $date_filename . self::$filename_ext;

        // get contents if exists
        //READ EXISTS CONTENT
        $already_content = '';
        if(file_exists($filename))
        {
            $file = new SplFileObject($filename, 'r');

            //if( $file->getSize()>5 )
            $already_content = $file->fread( $file->getSize() ) . PHP_EOL;
        }
        
        //WRITE NEW CONTENT
        $file = new SplFileObject($filename, 'w');
        
        // new content
        $new_content = $already_content . $append_data;
        
        //WRITING
        if( $file->isWritable() )
            if( !$file->rewind() && !$file->fwrite($new_content) )
                { user_error('Can\'t write new content in File '.$file->getFilename().'!', E_USER_WARNING); return FALSE; }
            else 
                return TRUE;

        return FALSE;
    }
    
    /**
     * Valid and create directory
     * Basepath / logger_path
     * 
     * @used in write()
     * @return string 
     */
    protected static function _valid_dir($logger)
    {
        stringtype($logger); 
        
        $base_path = self::getBasePath();

        if(is_null($base_path)) 
            return FALSE;
        
        //create directory
        if(!is_dir($base_path)) 
            if(!mkdir($base_path)) 
                { user_error ($base_path.' not writable!', E_USER_NOTICE); return FALSE; }
            
        // directory
        $d = dir($base_path);
        
        //accept dir/ OR dir
        $dlogger_path = $d->path . preg_replace('#\/$#','',$logger) . '/';
        
        //create LOGGER directory
        if(!is_dir($dlogger_path)) 
            if(!mkdir($dlogger_path)) 
                { user_error ($dlogger_path.' not writable!', E_USER_NOTICE); return FALSE; }
        
        return $dlogger_path;
    }





    
    
    


/*************************************************************
 * 
 *                      Class SeasLog::read
 * 
 ************************************************************/
    
    private static $scanned_files_list = NULL;
    
    /**
     * 
     * @param string $logger
     * @param integer $order
     * @return boolean|array
     */
    static function nextfile($logger, $order)
    {
        stringtype($logger); integertype($order); 

        if(NULL === self::$scanned_files_list) self::_scandir($logger, $order);
        
        // directory
        $d = dir(self::getBasePath());

        //accept dir/ OR dir
        $d_path = $d->path . preg_replace('#\/$#','',$logger) . '/';

        //no files
        if(empty(self::$scanned_files_list))
            return [];

        $filename = $d_path . current(self::$scanned_files_list);

        //positionne sur le prochain appel
        next(self::$scanned_files_list);

        //check if file
        if(!is_file($filename)) return FALSE;
        
        $file = new SplFileObject($filename);

        //READ
        if($file->isReadable())
        {
            //$contents = $file->fread($file->getSize());
            //$contents = explode(PHP_EOL, $contents);
            
            $contents=[];
            while (!$file->eof()) {
                //echo $f->fgets().' <br/>';
                $contents[] = $file->fgets();
            }

            //if($order !== SEASLOG_DETAIL_ORDER_DESC)
            $contents = array_reverse ($contents);

            return $contents;
        }
        
        return FALSE;
    }
    

    /**
     * Scan le repertoire entier pour récupérer chaque date différente des fichiers logs
     * @used in nextfile()
     * 
     * @param string $logger
     * @param integer $order
     * @return string 
     */
    private static function _scandir($logger, $order)
    {
        stringtype($logger); integertype($order); 
        // directory
        $d = dir(self::getBasePath());

        //accept dir/ OR dir
        $dir = new DirectoryIterator( $d->path . preg_replace('#\/$#','',$logger) . '/' );

        //impossible de lire le fichier
        //if(!$files_list = dir($d_path)) return FALSE;
        //if(!self::$scanned_files_list = dir($d_path)) return FALSE;

        foreach($dir as $file)
        {
            if ($file->isDot() || $file->isDir()) continue; 
            if (preg_match('/index\./',$file->getFilename())) continue; 

            //unset(self::$scanned_files_list[$k]);
            self::$scanned_files_list[] = $file->getFilename();
        }
        //reset(self::$scanned_files_list);

        return self::$scanned_files_list;
    }
    
    
    
    
}
       
        
  