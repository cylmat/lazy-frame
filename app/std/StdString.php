<?php

//namespace StdCore/StdString;

/**
 * Class StdString 
 * 
 * @package    StdString
 * @copyright  Copyright (c) Url (fr) 2018
 * @version    2019 - 01 - 02 
 * @author     Cylmat
 * @license    http://creativecommons.org/licenses/by/2.0/fr/ Creative Commons
 */
         
/*
 * Class StdString
 * 
 * http://php.net/manual/fr/ref.strings.php
 * 
 * var_dump(transliterator_transliterate('Any-Latin; Latin-ASCII; Lower()', "A æ Übérmensch på høyeste nivå! И я люблю PHP! ﬁ"));
 */

/**********************************************************************
 * 
 *          TODO
 * 
 *      tests on 'implode', 'join' functions!
 *      tests on integer and array-returned functions
 * 
 */
class StdString {
    
    /*
     * @string
     */
    private $original_string=NULL;
    
    /*
     * @string
     */
    private $string=NULL;
    
    /*
     * @array
     */
    private $modifications = [];
    
    /**
     * No-string result
     */
    private $result=NULL;
    
    /**
     * error result
     */
    private $errors=[];
    
    
    /**
     * Authorized string-returned functions
     */
    private static $authorized_string_fct = [
        //Ajoute des slash dans une chaîne, à la mode du langage C
        'addcslashes', //string addcslashes ( string $str , string $charlist )
        //Ajoute des antislashs dans une chaîne
        'addslashes', //string addslashes ( string $str )
        //Convertit des données binaires en représentation hexadécimale
        'bin2hex', //string bin2hex ( string $str )
        'chop', //Cette fonction est un alias de : rtrim(). 
        //Scinde la chaîne body en segments de chunklen octets de longueur.
        'chunk_split', //string chunk_split ( string $body [, int $chunklen = 76 [, string $end = "\r\n" ]] )
        //Convertit une chaîne d'un jeu de caractères cyrillique à l'autre
        'convert_cyr_string', //string convert_cyr_string ( string $str , string $from , string $to )
        //Décode une chaîne au format uuencode
        'convert_uudecode', //string convert_uudecode ( string $data )
        //Encode une chaîne de caractères en utilisant l'algorithme uuencode
        'convert_uuencode', //string convert_uuencode ( string $data )
        //Hachage à sens unique (indéchiffrable)
        'crypt', //string crypt ( string $str [, string $salt ] )
        //Convertit un texte logique hébreux en texte visuel
        'hebrev', //string hebrev ( string $hebrew_text [, int $max_chars_per_line = 0 ] )
        //Convertit un texte logique hébreux en texte visuel, avec retours à la ligne
        'hebrevc', //string hebrevc ( string $hebrew_text [, int $max_chars_per_line = 0 ] )
        //Convertit une chaîne binaire encodée en hexadécimal
        'hex2bin', //string hex2bin ( string $data )
        //Convertit les entités HTML à leurs caractères correspondant
        //html_entity_decode() est la fonction contraire de htmlentities() : elle convertit les entités HTML de la chaîne string en leurs caractères correspondant. 
        'html_entity_decode', //string html_entity_decode ( string $string [, int $flags = ENT_COMPAT | ENT_HTML401 [, string $encoding = ini_get("default_charset") ]] )
        //Convertit tous les caractères éligibles en entités HTML
        //htmlentities() est identique à la fonction htmlspecialchars(), sauf que tous les caractères qui ont des équivalents en entités HTML sont effectivement traduits. 
        'htmlentities', //string htmlentities ( string $string [, int $flags = ENT_COMPAT | ENT_HTML401 [, string $encoding = ini_get("default_charset") [, bool $double_encode = TRUE ]]] )
        // Convertit les entités HTML spéciales en caractères 
        //Cette fonction est l'opposée de htmlspecialchars(). Elle convertit les entités HTML spéciales en caractères. 
        'htmlspecialchars_decode', //string htmlspecialchars_decode ( string $string [, int $flags = ENT_COMPAT | ENT_HTML401 ] )
        //Convertit les caractères spéciaux en entités HTML
        'htmlspecialchars', //string htmlspecialchars ( string $string [, int $flags = ENT_COMPAT | ENT_HTML401 [, string $encoding = ini_get("default_charset") [, bool $double_encode = true ]]] )
        //Rassemble les éléments d'un tableau en une chaîne
        'implode', //string implode ( string $glue , array $pieces )     //string implode ( array $pieces )
        'join', //Alias de implode()
        'lcfirst', //string lcfirst ( string $str )
        'ltrim',
        'md5_file', 
        'md5', 
        'metaphone', 
        'money_format', 
        'nl_langinfo', 
        'nl2br', 
        'number_format', 
        'quoted_printable_decode', 
        'quoted_printable_encode', 
        'quotemeta', 
        'rtrim', 
        'setlocale', 
        'sha1_file', 
        'sha1', 
        'soundex', 
        'sprintf', 
        'str_pad', 
        'str_repeat', 
        //Effectue un encodage ROT13 de la chaîne str et retourne le résultat. 
        'str_rot13', //string str_rot13 ( string $str )
        'str_shuffle', 
        'strchr', //Alias de strstr()
        'strip_tags', //Supprime les balises HTML et PHP d'une chaîne
        'stripcslashes', //Décode une chaîne encodée avec addcslashes()
        'stripslashes', //Supprime les antislashs d'une chaîne
        'stristr', //Version insensible à la casse de strstr()
        //Recherche un ensemble de caractères dans une chaîne de caractères
        'strpbrk', //string strpbrk ( string $haystack , string $char_list )
        //Trouve la dernière occurrence d'un caractère dans une chaîne
        'strrchr', //string strrchr ( string $haystack , mixed $needle )
        //Inverse une chaîne Retourne la chaîne string, après avoir changé l'ordre des caractères. 
        'strrev', //string strrev ( string $string )
        //Trouve la première occurrence dans une chaîne
        'strstr', //string strstr ( string $haystack , mixed $needle [, bool $before_needle = FALSE ] )
        //Coupe une chaîne en segments
        'strtok', //string strtok ( string $str , string $token )      //string strtok ( string $token )
        'strtolower', //string strtolower ( string $string )
        'strtoupper', //string strtoupper ( string $string )
        //Remplace des caractères dans une chaîne
        'strtr', //string strtr ( string $str , string $from , string $to )      //string strtr ( string $str , array $replace_pairs )
        //Retourne un segment de chaîne
        'substr', //string substr ( string $string , int $start [, int $length ] )
        //Supprime les espaces (ou d'autres caractères) en début et fin de chaîne 
        'trim', //string trim ( string $str [, string $character_mask = " \t\n\r\0\x0B" ] )
        'ucfirst', //string ucfirst ( string $str )
        //Met en majuscule la première lettre de tous les mots
        'ucwords', //string ucwords ( string $str [, string $delimiters = " \t\r\n\f\v" ] )
        //Retourne une chaîne formatée
        'vsprintf', //string vsprintf ( string $format , array $args )
        //Effectue la césure d'une chaîne
        'wordwrap', //string wordwrap ( string $str [, int $width = 75 [, string $break = "\n" [, bool $cut = FALSE ]]] )
        
        //preg_quote() ajoute un antislash devant tous les caractères de la chaîne str. 
        //Cela est très utile si vous avez une chaîne qui va servir de masque, mais qui est générée durant l'exécution. 
        //Les caractères spéciaux qui seront protégés sont les suivants : . \ + * ? [ ^ ] $ ( ) { } = ! < > | : -
        'preg_quote', //string preg_quote ( string $str [, string $delimiter = NULL ] )
        //
        //Analyse subject pour trouver l'expression rationnelle pattern et remplace les résultats par replacement. 
        'preg_replace', //mixed preg_replace ( mixed $pattern , mixed $replacement , mixed $subject [, int $limit = -1 [, int &$count ]] )
        
        //Décode une chaîne en MIME base64
        'base64_decode', //string base64_decode ( string $data [, bool $strict = FALSE ] )
        //Encode une chaîne en MIME base64
        'base64_encode', //string base64_encode ( string $data )
        //rawurldecode() retourne la chaîne str dont les séquences de caractères %xy, 
        //avec xy deux valeurs hexadécimales, auront été remplacées par le caractère ASCII correspondant. 
        'rawurldecode', //string rawurldecode ( string $str )
        //Encode la chaîne fournie, en accord avec la » RFC 3986. 
        'rawurlencode', //string rawurlencode ( string $str )
        //Décode toutes les séquences %## et les remplace par leur valeur. Les caractères '+' sont décodés en un caractère d'espacement. 
        'urldecode', //string urldecode ( string $str )
        //Encode une chaîne en URL
        'urlencode', //string urlencode ( string $str )
        
        //Converts a string with ISO-8859-1 characters encoded with UTF-8 to single-byte ISO-8859-1 
        'utf8_decode', //string utf8_decode ( string $data )
        //Encodes an ISO-8859-1 string to UTF-8
        'utf8_encode', //string utf8_encode ( string $data )
        
        //Convert string to requested character encoding, Performs a character set conversion on the string str from in_charset to out_charset. 
        'iconv' //string iconv ( string $in_charset , string $out_charset , string $str )
    ];
    
    /**
     * Authorized integer-returned functions
     */
    private static $authorized_integer_fct = [
        //Calcule la somme de contrôle CRC32
        'crc32', //int crc32 ( string $str )
        //Écrit une chaîne formatée dans un flux
        'fprintf', //int fprintf ( resource $handle , string $format [, mixed $... ] )
        //Calcule la distance Levenshtein entre deux chaînes
        'levenshtein', //int levenshtein ( string $str1 , string $str2 )   //int levenshtein ( string $str1 , string $str2 , int $cost_ins , int $cost_rep , int $cost_del )
        //Affiche une chaîne de caractères formatée
        'printf', //int printf ( string $format [, mixed $args [, mixed $... ]] )
        //Calcule la similarité entre les deux chaînes first et second, selon la méthode décrite dans Programming Classics
        'similar_text', //int similar_text ( string $first , string $second [, float &$percent ] )
        //Comparaison insensible à la casse de chaînes binaires
        'strcasecmp', //int strcasecmp ( string $str1 , string $str2 )
        //Comparaison binaire de chaînes
        'strcmp', //int strcmp ( string $str1 , string $str2 )
        //Comparaison de chaînes localisées sensible à la casse
        'strcoll', //int strcoll ( string $str1 , string $str2 )
        //Trouve un segment de chaîne ne contenant pas certains caractères
        'strcspn', //int strcspn ( string $subject , string $mask [, int $start [, int $length ]] )
        //Recherche la position de la première occurrence dans une chaîne, sans tenir compte de la casse
        'stripos', //int stripos ( string $haystack , mixed $needle [, int $offset = 0 ] )
        //Calcule la taille d'une chaîne
        'strlen', //int strlen ( string $string )
        //Comparaison de chaînes avec l'algorithme d'"ordre naturel" (insensible à la casse)
        'strnatcasecmp', //int strnatcasecmp ( string $str1 , string $str2 )
        //Comparaison de chaînes avec l'algorithme d'"ordre naturel"
        'strnatcmp', //int strnatcmp ( string $str1 , string $str2 )
        //Compare en binaire des chaînes de caractères similaire à strcasecmp(), mais permet de limiter le nombre de caractères utilisés
        'strncasecmp', //int strncasecmp ( string $str1 , string $str2 , int $len )
        //Comparaison binaire des n premiers caractères
        'strncmp', //int strncmp ( string $str1 , string $str2 , int $len )
        //Cherche la position de la première occurrence dans une chaîne
        'strpos', //int strpos ( string $haystack , mixed $needle [, int $offset = 0 ] )
        //Cherche la position de la dernière occurrence d'une chaîne contenue dans une autre, de façon insensible à la casse
        'strripos', //int strripos ( string $haystack , string $needle [, int $offset = 0 ] )
        //Cherche la position de la dernière occurrence d'une sous-chaîne dans une chaîne
        'strrpos', //int strrpos ( string $haystack , string $needle [, int $offset = 0 ] )
        // Trouve la longueur du segment initial d'une chaîne contenant tous les caractères d'un masque donné 
        'strspn', //int strspn ( string $subject , string $mask [, int $start [, int $length ]] )
        //Compare deux chaînes depuis un offset jusqu'à une longueur en caractères
        'substr_compare', //int substr_compare ( string $main_str , string $str , int $offset [, int $length [, bool $case_insensitivity = FALSE ]] )
        //Compte le nombre d'occurrences de segments dans une chaîne
        'substr_count', //int substr_count ( string $haystack , string $needle [, int $offset = 0 [, int $length ]] )
        //Écrit une chaîne formatée dans un flux
        'vfprintf', //int vfprintf ( resource $handle , string $format , array $args )
        //Affiche une chaîne formatée
        'vprintf', //int vprintf ( string $format , array $args )
//
        //Retourne le code erreur de la dernière expression PCRE exécutée
        'preg_last_error', //int preg_last_error ( void )
        // Analyse subject pour trouver l'expression pattern et met les résultats dans matches, dans l'ordre spécifié par flags.
        //Après avoir trouvé un premier résultat, la recherche continue jusqu'à la fin de la chaîne. 
        'preg_match_all', //int preg_match_all ( string $pattern , string $subject [, array &$matches [, int $flags = PREG_PATTERN_ORDER [, int $offset = 0 ]]] )
        //Effectue une recherche de correspondance avec une expression rationnelle standard
        'preg_match' //int preg_match ( string $pattern , string $subject [, array &$matches [, int $flags = 0 [, int $offset = 0 ]]] )
    ];
    
    /**
     * Authorized array-returned functions
     */
    private static $authorized_array_fct = [
        //Scinde une chaîne de charactères en segments
        'explode', //array explode ( string $delimiter , string $string [, int $limit = PHP_INT_MAX ] )
        //Retourne la table de traduction des entités utilisée par htmlspecialchars() et htmlentities()
        'get_html_translation_table', //array get_html_translation_table ([ int $table = HTML_SPECIALCHARS [, int $flags = ENT_COMPAT | ENT_HTML401 [, string $encoding = "UTF-8" ]]] )
        //Retourne un tableau associatif contenant les informations de formats localisées pour les nombres et la monnaie. 
        'localeconv', //array localeconv ( void )
        //Analyse une chaîne de caractères CSV dans un tableau
        'str_getcsv', //array str_getcsv ( string $input [, string $delimiter = "," [, string $enclosure = '"' [, string $escape = "\\" ]]] )
        //Convertit une chaîne de caractères en tableau
        'str_split', //array str_split ( string $string [, int $split_length = 1 ] )
//
        //preg_grep() retourne un tableau qui contient les éléments de input qui satisfont le masque pattern. 
        'preg_grep', //array preg_grep ( string $pattern , array $input [, int $flags = 0 ] )
        //Éclate une chaîne par expression rationnelle
        'preg_split' //array preg_split ( string $pattern , string $subject [, int $limit = -1 [, int $flags = 0 ]] )
        
        //Analyse subject pour trouver l'expression rationnelle pattern et remplace les résultats par replacement. 
        //'preg_replace' //mixed preg_replace ( mixed $pattern , mixed $replacement , mixed $subject [, int $limit = -1 [, int &$count ]] )
    ];
    
    
    /**
     * Authorized mixed-returned functions
     */
    private static $authorized_mixed_fct = [
        //Retourne des statistiques sur les caractères utilisés dans une chaîne
        'count_chars', //mixed count_chars ( string $string [, int $mode = 0 ] )
        //sscanf() est l'inverse de la fonction printf(). sscanf() lit des données dans la chaîne str, 
        //et l'interprète en fonction du format format, qui est décrit dans la documentation de la fonction sprintf(). 
        'sscanf', //mixed sscanf ( string $str , string $format [, mixed &$... ] )
        //Version insensible à la casse de str_replace()
        'str_ireplace', //mixed str_ireplace ( mixed $search , mixed $replace , mixed $subject [, int &$count ] )
        //Remplace toutes les occurrences dans une chaîne
        'str_replace', //mixed str_replace ( mixed $search , mixed $replace , mixed $subject [, int &$count ] )
        //Compte le nombre de mots utilisés dans une chaîne
        'str_word_count', //mixed str_word_count ( string $string [, int $format = 0 [, string $charlist ]] )
        //Remplace un segment dans une chaîne
        'substr_replace', //mixed substr_replace ( mixed $string , mixed $replacement , mixed $start [, mixed $length ] )
//
        //preg_filter() est identique à preg_replace(), mais elle ne fait que retourner les occurrences trouvées 
        //(éventuellement transformées). Pour plus de détails sur le fonctionnement de cette fonction, voyez preg_replace(). 
        'preg_filter', //mixed preg_filter ( mixed $pattern , mixed $replacement , mixed $subject [, int $limit = -1 [, int &$count ]] )
        //Rechercher et remplacer par expression rationnelle standard en utilisant une fonction de callback
        'preg_replace_callback' //mixed preg_replace_callback ( mixed $pattern , callable $callback , mixed $subject [, int $limit = -1 [, int &$count ]] )
    ];
    
    
    
    /**
     * STATIC CALL
     * 
     * @param type $string
     * @return \String
     */
    static function create($string)
    {
        return new StdString($string);
    }
    
    
    function __construct($string)
    {
        self::_string_arg($string, 'string', __METHOD__);
        
        $this->original_string = $string;
        $this->string = $string;
        
        //$this->_append_modification('');
        $this->modifications[] = '['.$this->string.']';
        return $this;
    }
    
    function __get($name)
    {
        if('result' === $name) return $this->result; 
    }
    
    /**
     * 
     * @return type
     */
    function __toString() 
    {
        return $this->string;
    }
    
    /**
     * 
     * @param string $string
     */
    function set_string($string, $pre='', $post='')
    {
        self::_string_arg($string, 'string', __METHOD__);
        self::_string_arg($pre, 'pre', __METHOD__);
        self::_string_arg($post, 'post', __METHOD__);
        
        $this->string = $pre.$string.$post;
        return $this;
    }
    
    /**
     * pre string
     */
    function pre($pre_string)
    {
        self::_string_arg($pre_string, 'pre_string', __METHOD__);
        $this->string = $pre_string . $this->string;
        return $this;
    }
    
    /**
     * post string
     */
    function post($post_string)
    {
        self::_string_arg($post_string, 'post_string', __METHOD__);
        $this->string = $this->string . $post_string;
        return $this;
    }
    
    
    
    
    
    
                                /**   **   Get   **   **/
    function get()
    {
        return $this->string;
    }
    
    function toString()
    {
        return $this->get();
    }
    
    function get_original()
    {
        return $this->original_string;
    }
    
    function get_modifications()
    {
        return $this->modifications;
    }
    
    /**
     * Return last result fct
     * For non-string functions
     * 
     * @return mixed
     */
    function get_result()
    {
        return $this->result;
    }
    
    function get_errors()
    {
        return $this->errors;
    }
    
    
    
                                /**   **   OUTPUT   **   **/
    
    //int print ( string $arg )
    //void echo ( string $arg1 [, string $... ] )
    function display($ext='')
    {
        self::_string_arg($ext, 'ext', __METHOD__);
        
        echo $this->get().$ext;
        return $this;
    }
    
    function display_result($ext='')
    {
        self::_string_arg($ext, 'ext', __METHOD__);
        
        echo $this->get_result().$ext;
        return $this;
    }
    
    function display_errors($pre=TRUE)
    {
        if($pre) print '<pre>';
        print_r( $this->get_result() );
        if($pre) print '</pre>';
        return $this;
    }
    
    /**
     * 
     * @param type $pre
     */
    function display_modifications($pre=TRUE)
    {
        if($pre) print '<pre>';
        print_r( $this->get_modifications() );
        if($pre) print '</pre>';
        return $this;
    }
    
    
    
    
    
    
                                /**   **   URL   **   **/
    function urldecode()
    {
        $this->string = urldecode($a, $b, $this->string);
        $this->_append_modification($this->string, 'strip_accents');
        return $this;
    }
    
    function urlencode()
    {
        $this->string = str_replace($a, $b, $this->string);
        $this->_append_modification($this->string, 'strip_accents');
        return $this;
    }
    
    
     
    
                            /**   **   STRIP ACCENTS   **   **/
    function strip_accents()
    {
      $a = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'Ā', 'ā', 'Ă', 'ă', 'Ą', 'ą', 'Ć', 'ć', 'Ĉ', 'ĉ', 'Ċ', 'ċ', 'Č', 'č', 'Ď', 'ď', 'Đ', 'đ', 'Ē', 'ē', 'Ĕ', 'ĕ', 'Ė', 'ė', 'Ę', 'ę', 'Ě', 'ě', 'Ĝ', 'ĝ', 'Ğ', 'ğ', 'Ġ', 'ġ', 'Ģ', 'ģ', 'Ĥ', 'ĥ', 'Ħ', 'ħ', 'Ĩ', 'ĩ', 'Ī', 'ī', 'Ĭ', 'ĭ', 'Į', 'į', 'İ', 'ı', 'Ĳ', 'ĳ', 'Ĵ', 'ĵ', 'Ķ', 'ķ', 'Ĺ', 'ĺ', 'Ļ', 'ļ', 'Ľ', 'ľ', 'Ŀ', 'ŀ', 'Ł', 'ł', 'Ń', 'ń', 'Ņ', 'ņ', 'Ň', 'ň', 'ŉ', 'Ō', 'ō', 'Ŏ', 'ŏ', 'Ő', 'ő', 'Œ', 'œ', 'Ŕ', 'ŕ', 'Ŗ', 'ŗ', 'Ř', 'ř', 'Ś', 'ś', 'Ŝ', 'ŝ', 'Ş', 'ş', 'Š', 'š', 'Ţ', 'ţ', 'Ť', 'ť', 'Ŧ', 'ŧ', 'Ũ', 'ũ', 'Ū', 'ū', 'Ŭ', 'ŭ', 'Ů', 'ů', 'Ű', 'ű', 'Ų', 'ų', 'Ŵ', 'ŵ', 'Ŷ', 'ŷ', 'Ÿ', 'Ź', 'ź', 'Ż', 'ż', 'Ž', 'ž', 'ſ', 'ƒ', 'Ơ', 'ơ', 'Ư', 'ư', 'Ǎ', 'ǎ', 'Ǐ', 'ǐ', 'Ǒ', 'ǒ', 'Ǔ', 'ǔ', 'Ǖ', 'ǖ', 'Ǘ', 'ǘ', 'Ǚ', 'ǚ', 'Ǜ', 'ǜ', 'Ǻ', 'ǻ', 'Ǽ', 'ǽ', 'Ǿ', 'ǿ');
      $b = array('A', 'A', 'A', 'A', 'A', 'A', 'AE','C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae','c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ','ij','J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE','oe','R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE','ae','O', 'o');
      $this->string = str_replace($a, $b, $this->string);
      $this->_append_modification($this->string, 'strip_accents');
      return $this;
    }
    
    /*function transiterateAccents()
    {
        $string = $this->string;
        $transliterator = Transliterator::createFromRules(':: Any-Latin; :: Latin-ASCII; :: NFD; :: [:Nonspacing Mark:] Remove; :: Lower(); :: NFC;', Transliterator::FORWARD);
        $normalized = $transliterator->transliterate($string);
        $this->string = $normalized;
        $this->_append_modification('transiterateAccents');
    }
    
    function withoutAccents($charset='utf-8')
    {
        $str = $this->string;
        $str = htmlentities($str, ENT_NOQUOTES, $charset);

        $str = preg_replace('#&([A-za-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $str);
        $str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str); // pour les ligatures e.g. '&oelig;'
        $str = preg_replace('#&[^;]+;#', '', $str); // supprime les autres caractères

        $this->string = $str;   // or add this : mb_strtoupper($str); for uppercase :)
        $this->_append_modification('withoutAccents');
    }
    
    function stripAccents() 
    {
        $str = $this->string;
        $this->string = strtr(utf8_decode($str), utf8_decode('àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ'), 'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');
        $this->_append_modification('stripAccents');
    }*/
    
    
    
    
                                /**   **   CALLED   **   **/
    
    function __call($fct_name, array $arguments=[]) 
    {
        //check if string
        self::_string_arg($fct_name, 'fct_name', __METHOD__);
        
        //check if php function exists
        if(!function_exists($fct_name)) {
            throw new Exception('Function '.$fct_name.' does\'nt exists');}

        $result='';
        
        // STRING FCT
        foreach(self::$authorized_string_fct as $php_string_fct)
        {
            if($fct_name !== $php_string_fct) continue;
            $result='string';
            $this->_call_string_fct($fct_name, $arguments);
        }
        
        // integer-returned FCT
        foreach(self::$authorized_integer_fct as $php_integer_fct)
        {
            if($fct_name !== $php_integer_fct) continue;
            $result='integer';
            $this->_call_nostring_fct($fct_name, $arguments);
        }
        
        // Array-returned FCT
        foreach(self::$authorized_array_fct as $php_array_fct)
        {
            if($fct_name !== $php_array_fct) continue;
            $result='array';
            $this->_call_nostring_fct($fct_name, $arguments);
        }
        
        // mixed-returned FCT
        foreach(self::$authorized_mixed_fct as $php_mixed_fct)
        {
            if($fct_name !== $php_mixed_fct) continue;
            $result='mixed';
            $this->_call_nostring_fct($fct_name, $arguments);
        }
        
        //if('string'===$result)
            return $this; //enchainer
        //else
          //  return $this->last_result; //final
    }
    
    /**
     * 
     */
    private function _call_string_fct($fct_name, array $arguments=[])
    {
        self::_string_arg($fct_name, 'fct_name', __METHOD__);
        
        //ajoute le string en 1er argument
        $offset=1;
        switch($fct_name)
        {
            case 'preg_replace': $offset=3; break;
            case 'iconv': $offset=3; break;
        }
        array_splice ( $arguments , $offset-1 , 0, $this->string );
        
        $this->string = call_user_func_array($fct_name, $arguments);
        
        //ERROR
        if(!is_string($this->string))
            $this->_set_error($this->string, __METHOD__);
            
        $this->_append_modification($this->string, $fct_name);
    }
    
    /**
     * 
     */
    private function _call_nostring_fct($fct_name, array $arguments=[])
    {
        self::_string_arg($fct_name, 'fct_name', __METHOD__);
        
        //ajoute le string en 1er d'argument
        $offset=1;
        switch($fct_name)
        {
            case 'fprintf': $offset=2; break;
        }
        //splice
        $string = $this->string;
        array_splice ( $arguments , $offset-1 , 0, $string ); 
        
        $this->result = call_user_func_array($fct_name, $arguments);
        
        //ERROR
        if(is_bool($this->result))
            $this->_set_error($this->result, __METHOD__);
        
        $this->_append_modification($this->result, $fct_name);
    }
    
    
    
    
    
    
                            /**   **   PRIVATE   **   **/
    
    /**
     * 
     * @param mixed $modif
     * @param string $fct
     */
    private function _append_modification($modif, $fct)
    {
        //first 
        //if('' === $a) {$this->modifications[] = $this->string;return;}
            
        if(!is_array($modif) && !is_object($modif))
            $this->modifications[] = $fct.': ['.$modif.']';
        else
            $this->modifications[] = [$fct=>$modif];
    }
    
    /*
     * Set errors
     */
    function _set_error($result, $method)
    {
        $this->errors[] = ['result'=>$result, 'method'=>$method];
    }
    
    
    /**
     * validate string argument or throws exception
     * 
     * @param type $arg_value
     * @param type $arg_name
     * @param type $method_name
     * @return boolean
     * @throws Exception
     */
    private static function _string_arg($arg_value, $arg_name, $method_name)
    {
        //if(is_null($arg_value)) return FALSE;
        if(!is_string($arg_value)) { throw new Exception('Param @'.$arg_name.' of method '.$method_name.' must be a string'); return FALSE; }
        
        //return $arg_value;
    }
    
}





/*
 * Class Filter
 */
class Filter {
    /*
     * [0] => int
    [1] => boolean
    [2] => float
    [3] => validate_regexp
    [4] => validate_url
    [5] => validate_email
    [6] => validate_ip
    [7] => string
    [8] => stripped
    [9] => encoded
    [10] => special_chars
    [11] => unsafe_raw
    [12] => email
    [13] => url
    [14] => number_int
    [15] => number_float
    [16] => magic_quotes
    [17] => callback
     * 
     * 
     * FILTER_VALIDATE_BOOLEAN
     * FILTER_VALIDATE_DOMAIN
     * FILTER_VALIDATE_EMAIL
     * FILTER_VALIDATE_FLOAT
     * FILTER_VALIDATE_INT
     * FILTER_VALIDATE_IP
     * FILTER_VALIDATE_REGEXP
     * FILTER_VALIDATE_URL
     * 
     * FILTER_SANITIZE_EMAIL
     * FILTER_SANITIZE_ENCODED
     * FILTER_SANITIZE_MAGIC_QUOTES
     */
}
