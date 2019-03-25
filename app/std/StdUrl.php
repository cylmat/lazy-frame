<?php 

/**
 * Class FluentUrl 
 * 
 * @package    StdUrl
 * @copyright  Copyright (c) Url (fr) 2018
 * @author     Cylmat
 * @license    http://creativecommons.org/licenses/by/2.0/fr/ Creative Commons
 * 
 * --
 * Using StdUrl
 * FILTER_FLAG_SCHEME_REQUIRED | FILTER_FLAG_HOST_REQUIRED | FILTER_FLAG_PATH_REQUIRED | FILTER_FLAG_QUERY_REQUIRED
 * 
 * $url = StdUrl::set('http://exemple.com')->sanitize()->validate( ['host'] )->urlencode()->get();
 * $s = $url->scheme;
 * $p = $url->path;
 * $v = $url->isValid;
 * 
 */


//namespace FluentUrl;

//class StdUrl extends FluentUrl {}

//class FluentUrl {

class StdUrl {
    
    private static $SEP_ROOT = '://';
    private static $SEP = '/';
    private static $FRAG = '#';
    private static $QUERY = '?';
    
    /**
     * @var string 
     */
    private $original_url=NULL; 
    private $url=NULL; 
    
    /*
     * error
     */
    private $error_msg=NULL;
    
    /**
     * REQUEST URL
     */
    private $scheme=NULL; // http | https | ftp
    private $host=NULL; // www.exemple.fr
    private $scheme_host=NULL; // https://www.exemple.fr
    
    private $path=NULL; 
    private $query=NULL; 
    private $fragment=NULL; 
    
    /*
     * valid
     */
    private $scheme_match=NULL;
    private $host_match=NULL;
    private $path_match=NULL;
    private $query_match=NULL;
    private $fragment_match=NULL;
    
    private $required_flags;
    private $required_valid;
    private $isValid=NULL; 
    
    /**
     * QUERY http_build_query()
     */
    private $query_array=[];
    
    /**
     * Set the url
     * 
     * @param string $url
     * 
     * @param string $flags = NULL | FILTER_FLAG_SCHEME_REQUIRED | FILTER_FLAG_HOST_REQUIRED | FILTER_FLAG_PATH_REQUIRED | FILTER_FLAG_QUERY_REQUIRED
     *  default: FILTER_FLAG_SCHEME_REQUIRED && FILTER_FLAG_HOST_REQUIRED
     * 
     * @return \StdUrl
     */
    static function create($url, $FLAGS=NULL)
    {
        return new StdUrl($url, $FLAGS);
    }
    
    
    /**
     * Set the url
     * 
     * @param string $url
     * @return \StdUrl
     */
    function __construct($url) 
    {
        self::_string($url, 'url', __METHOD__);
        $this->set_url($url);
        
        return $this;
    }
    
    /**
     * 
     * @param string $url
     * @return boolean|\StdUrl
     */
    public function set_url($url)
    {
        self::_string($url, 'url', __METHOD__);
        
        $this->original_url = $url; 
        $this->url = $url;
        $this->_clear();
        
        if(!$this->_setDetails()) return FALSE;
        
        $this->validate();
        return $this;
    }
    
    
    /**
     * 
     */
    private function _clear()
    {
        $this->scheme=NULL; // http | https | ftp
        $this->host=NULL; // www.exemple.fr
        $this->scheme_host=NULL; // https://www.exemple.fr

        $this->path=NULL; 
        $this->query=NULL; 
        $this->fragment=NULL; 
    
        $this->query_array=[];
        $this->error_msg='';
        
        //valid
        $this->isValid=FALSE;
        $this->required_flags=NULL;
        $this->required_valid=TRUE;
        
        $this->scheme_match=NULL;
        $this->host_match=NULL;
        $this->path_match=NULL;
        $this->query_match=NULL;
        $this->fragment_match=NULL;
    }
    
    
    
    
    
                                    /**   **   GET   **   **/
    
    /**
     * URL
     * 
     * @return string
     */
    public function get()
    {
        $this->validate();
        return $this->url;
    }
    
    /**
     * URL
     * 
     * @return string
     */
    public function toString()
    {
        return $this->get();
    }
    
    /*
     * One param
     * @return string
     */
    public function get_param($param_name)
    {
        self::_string($param_name, 'param_name', __METHOD__);
        $this->validate();
        
        if(property_exists($this, $param_name))
            if(empty($this->$param_name))
                return ' ';
            else 
                return $this->$param_name;
        return FALSE;
    }
    
    /**
     * 
     * @return array
     */
    public function get_params()
    {
        //$p = get_object_vars($this);
        $this->validate();
        $p = [
            'original_url'=>$this->original_url,
            'url'=>$this->url,
            'scheme'=>$this->scheme,
            'host'=>$this->host,
            'scheme_host'=>$this->scheme_host,
            'path'=>$this->path,
            'query'=>$this->query,
            'fragment'=>$this->fragment,
            'isValid'=>($this->isValid?'true':'false'),
            'required_valid'=>($this->required_valid?'true':'false'),
            'scheme_match'=>$this->scheme_match,
            'host_match'=>$this->host_match,
            'path_match'=>$this->path_match,
            'query_match'=>$this->query_match,
            'fragment_match'=>$this->fragment_match,
            'required_flags'=>$this->required_flags,
            'query_array'=>$this->query_array
        ];
        return $p; 
    }
    
    public function isValid() //array $FLAGS=[])
    {
        //if([] !== $FLAGS) $this->validate($FLAGS);
        $this->validate();
        return $this->isValid;
    }
    
    /*
     * ERROR MSG
     */
    public function get_error_msg()
    {
        //$this->validate();
        return $this->error_msg;
    }
    
    
    
    
    
    
                                        /*  *  DISPLAY  *  */
    public function display($ext='')
    {
        self::_string($ext, 'ext', __METHOD__);
        echo $this->get() . $ext;
        return $this;   
    }
    
    
    public function display_param($param_name, $ext=NULL)
    {
        if(!$param_value = $this->get_param($param_name)) return FALSE;
        self::_string($ext, 'ext', __METHOD__);
        
        echo $param_value . $ext;
        return $this;
    }
    
    public function display_params($pre=TRUE)
    {
        if($pre) print '<pre>';
        print_r($this->get_params());
        if($pre) print '</pre>';
        return $this;
    }
    
    public function display_error_msg($ext='')
    {
        self::_string($ext, 'ext', __METHOD__);
        echo $this->get_error_msg() . $ext;
        
        return $this;
    }
    
    
    
    
    
    
    
    
                                /**   **   SET   **   **/
    /**
     * 
     * @param type $param_name
     * @param type $value
     * @return boolean|\StdUrl
     */
    public function set_param($param_name, $value)
    {
        self::_string($param_name, 'param_name', __METHOD__);
        self::_string($value, 'value', __METHOD__);
        
        //$arg_value = filter_var($arg_value, FILTER_SANITIZE_STRING);
        if(!property_exists($this, $param_name)) {$this->_error_msg('Setting param '.$param_name.' not set'); return FALSE;}

        $this->$param_name = $value;
        $this->_update_url();
        //$this->validate();
        
        return $this;
    }
    

    /**
     * 
     * @param array $params
     * @return \StdUrl
     */
    public function set_params(array $params)
    {
        foreach($params as $item => $v)
            $this->set_param($item, $v);
        
        //$this->validate();
        return $this;
    }
    
    
    
                                /**   **   MAGIC   **   **/
    
    /**
     * Return object param
     * 
     * @param string $param_name
     * @return boolean
     * @throws Exception
     */
    public function __get($param_name)
    {
        self::_string($param_name, 'param_name', __METHOD__);
        $this->validate();
        
        if(property_exists($this, $param_name))
            return $this->$param_name;
    }
    
    
    public function __toString()
    {
        return $this->get();
    }
    
    
    
    
    
    
    
                                    /**   **   FCT   **   **/
    
    /**
     * Sanitize url
     * 
     * Supprime tous les caractères sauf les lettres, chiffres et $-_.+!*'(),{}|\\^~[]`<>#%";/?:@&=. 
     */
    public function sanitize()
    {
        $this->url = filter_var($this->url, FILTER_SANITIZE_URL);
        return $this;
    }
    
    /**
     * Validate url
     * 
     * Valide une URL (selon » http://www.faqs.org/rfcs/rfc2396),
     * 
     * @param string $FLAGS = FILTER_FLAG_SCHEME_REQUIRED | FILTER_FLAG_HOST_REQUIRED | FILTER_FLAG_PATH_REQUIRED | FILTER_FLAG_QUERY_REQUIRED
     *  default: FILTER_FLAG_SCHEME_REQUIRED && FILTER_FLAG_HOST_REQUIRED
     * 
     * @return StdUrl|FALSE
     */
    public function validate() //array $FLAGS=[])
    {
        $validate = TRUE;
        
        //TEST SUR STRTOLOWER!!
        if(!empty($this->scheme_match)) if(!preg_match('#'.$this->scheme_match.'#', strtolower($this->scheme))) $validate = FALSE;
        if(!empty($this->host_match)) if(!preg_match('#'.$this->host_match.'#', strtolower($this->host))) $validate = FALSE;
        
        //TESTS
        if(!empty($this->path_match)) if(!preg_match('#'.$this->path_match.'#', $this->path)) $validate = FALSE;
        if(!empty($this->fragment_match)) if(!preg_match('#'.$this->fragment_match.'#', $this->fragment)) $validate = FALSE;
        if(!empty($this->query_match)) if(!preg_match('#'.$this->query_match.'#', $this->query)) $validate = FALSE;
        
        if(!$this->required_valid) $validate = FALSE;
        
        if(!filter_var($this->url, FILTER_VALIDATE_URL)) 
        {
            $validate = FALSE;
            $this->_error_msg($this->url.' is not valid');
        }
            
        $this->isValid = $validate;
        return $this;
    }
    
    /**
     * Validate url
     * 
     * Valide une URL (selon » http://www.faqs.org/rfcs/rfc2396),
     * 
     * @param string $FLAGS = FILTER_FLAG_SCHEME_REQUIRED | FILTER_FLAG_HOST_REQUIRED | FILTER_FLAG_PATH_REQUIRED | FILTER_FLAG_QUERY_REQUIRED
     *  default: FILTER_FLAG_SCHEME_REQUIRED && FILTER_FLAG_HOST_REQUIRED
     * 
     * @return StdUrl|FALSE
     */
    public function required(array $FLAGS=[])
    {
        //$this->isValid = TRUE;
        $this->required_flags=$FLAGS;
        $this->required_valid=TRUE;
        
        foreach($FLAGS as $F)
        {
            $FLG = 0;
            switch($F)
            {
                case 'scheme': $FLG = FILTER_FLAG_SCHEME_REQUIRED; break;
                case 'host': $FLG = FILTER_FLAG_HOST_REQUIRED; break;
                case 'path': $FLG = FILTER_FLAG_PATH_REQUIRED; break;
                case 'query': $FLG = FILTER_FLAG_QUERY_REQUIRED; break;
            }
            if(!filter_var($this->url, FILTER_VALIDATE_URL, $FLG)) 
            {
                $this->required_valid= FALSE;
                $this->_error_msg($this->url.' with flag '.$FLG.' is not valid');
            }
        }
        //$this->validate();
        return $this;
    }
    
    
    
    /**
     * 
     * @param array $match_cases
     * @return boolean
     */
    function scheme_match($match_cases=NULL)
    {
        $this->scheme_match=NULL;
        
        if(is_string($match_cases))
            $this->scheme_match = $match_cases;
        else
            if(is_array($match_cases))
            {
                $c=0;
                foreach($match_cases as $item)
                    $this->scheme_match .= ($c++>0?'|':'').$item;
            }
        
        //$this->validate(); 
        return $this;
    }
    
    /**
     * 
     * @param array $match_cases
     * @return boolean
     */
    function host_match($match_cases=NULL)
    {
        $this->host_match=NULL;
        
        if(is_string($match_cases))
            $this->host_match = $match_cases;
        else
            if(is_array($match_cases))
            {
                $c=0;
                foreach($match_cases as $item)
                    $this->host_match .= ($c++>0?'|':'').$item;
            }
        
        //$this->validate();
        return $this;
    }
                   
    /*
     * Cette fonction est utile lors de l'encodage d'une chaîne de caractères à utiliser dans la partie d'une URL, 
     * comme façon simple de passer des variables vers la page suivante. 
     */
    public function urlencode()
    {
        $this->url = urlencode($this->url);
        return $this;
    }
    
    /**
     * Décode toutes les séquences %## et les remplace par leur valeur. Les caractères '+' sont décodés en un caractère d'espacement. 
     */
    public function urldecode()
    {
        $this->url = urldecode($this->url);
        return $this;
    }
    
    public function utf8_encode ()
    {
        $this->url = utf8_encode($this->url);
        return $this;
    }
    
    public function utf8_decode ()
    {
        $this->url = utf8_encode($this->url);
        return $this;
    }
    
    //Encodes the given string according to » RFC 3986. 
    public function rawurlencode ()
    {
        $this->url = rawurlencode ($this->url );
        return $this;
    }
    
    public function rawurldecode ()
    {
        $this->url = rawurldecode ( $this->url );
        return $this;
    }
    
    /**
     * mixed $query_data
     * string $numeric_prefix 
     * string $arg_separator 
     * int $enc_type = PHP_QUERY_RFC1738 
     */
    /*public function http_build_query( $query_data, $numeric_prefix, $arg_separator, $enc_type = PHP_QUERY_RFC1738 )
    {
        if(!is_array($query_data) || !is_object($query_data)) return $this;
        
        if( $query = http_build_query($query_data, $numeric_prefix, $arg_separator, $enc_type) )
            $this->url .= $query;
                
        return $this;
    }*/
    
      
    
    
    
    
                                         /**   **   PRIVATES   **   **/
    
    
    
    /**
     * Update
     */
    private function _update_url()
    {
        //$this->scheme_host = $this->scheme . self::$SEP_ROOT . $this->host;
        $this->scheme_host = $this->scheme ? $this->scheme . self::$SEP_ROOT : '';
            $this->scheme_host .= $this->host;
            
        $scheme_host = $this->scheme_host;
        
        $path = $this->path ? $this->path : '';
        $query = $this->query ? self::$QUERY . $this->query  : '';
        $frag = $this->fragment ? self::$FRAG . $this->fragment : '';

        $this->url = $scheme_host . $path . $query . $frag;
        if( !parse_url ( $this->url ) ) { $this->_error_msg('Update url failed'); return FALSE; } //url non valide

        //$this->validate();
        
        return TRUE;
    }
    
    
    /**
     * 
     * @param type $url
     * @return boolean
     */
    private function _setDetails()
    {
        if( !$p = parse_url ( $this->url ) ) { $this->_error_msg('Parse_url failed'); return FALSE; } //url non valide

        $this->scheme = isset($p['scheme']) ? $p['scheme'] : '';
        $this->host = isset($p['host']) ? $p['host'] : '';
        $this->scheme_host = $this->scheme ? $this->scheme . self::$SEP_ROOT : '';
            $this->scheme_host .= $this->host;
            
        $this->path = isset($p['path']) ? $p['path'] : '';
        $this->query = isset($p['query']) ? $p['query'] : '';
        $this->fragment = isset($p['fragment']) ? $p['fragment'] : '';

        //$this->validate();
        
        return TRUE;
    }
    
    private function _error_msg($msg)
    {
        $this->error_msg .= 'ERROR:'.$msg.'<br/>'.PHP_EOL;
    }
    
    
    
    
    
    
    
                                /**   **   STATICS   **   **/
    
    /**
     * validate string argument or throws exception
     * 
     * @param type $arg_value
     * @param type $arg_name
     * @param type $method_name
     * @return boolean
     * @throws Exception
     */
    private static function _string($arg_value, $arg_name, $method_name)
    {
        if(is_null($arg_value)) return FALSE;
        if(!is_string($arg_value)) { throw new Exception('Param @'.$arg_name.' of method '.$method_name.' must be a string'); return FALSE; }
        
    }
    
    
    
}

/**
 * Après maintes péripéties, les deux roues et ce bicycle que voici, tombèrent en des mains légères mais étrangères, 
 * tandis qu'en ce jour amère triste semblait son ancienne propriétaire. 
 * 
 * Alors voici que maintenant, grâce à vous et nous vous en remercions chaleureusement, 
 * va lui être offert un solide bolide en fer aux courbes tout de même familières, pour son joyeux anniversaire !
 * 
 * Afin de parcourir de nouveau les bords de Seine, encore un grand merci à vous tous de délester une once de votre bourse, 
 * et sans l'ombre d'un doute lui redonner le plaisir de la route :)
 */