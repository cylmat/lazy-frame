<?php

//namespace StdCore/StdTest;
//include_once __DIR__.'init.php';

/**
 * Class StdCache
 * 
 * @package    StdCache
 * @copyright  Copyright (c) Url (fr) 2018
 * @since      19 decembre 2018
 * @author     Cylmat
 * @license    http://creativecommons.org/licenses/by/2.0/fr/ Creative Commons
 * 
 */

class StdTest
{
    /**
     *
     * @var boolean 
     */
    //private static $isRunning=FALSE;
      /* Clear
     */
    /*private static function _clear()
   {
        self::$isRunning=TRUE;
        self::$RESULTS=[];
        self::$totalCount=0;
   }*/
   
    
    /**
     *
     * Tableau des resultats a afficher
     * @var array 
     */
    private static $RESULTS=[];
    
    /**
     * Nombre de tests total
     * @var integer 
     */
    private static $totalCount=0;
    
    /**
     * used for get_asserts() only once
     * @var boolean
     */
    private static $get_asserts_already_called=FALSE; 
    
    /**
     * Classes not testeds
     * @var array
     */
    private static $option_notTested=[];
    
    /**
     * Theses classes only
     * @var array
     */
    private static $option_onlyTested=[];
    
    /**
     * @var string
     */
    private static $last_class_called=FALSE; 
    
    /**
     * @var string
     */
    private static $last_fct_called=FALSE; 

    
    
    
    
    /**
     *
     * @var string 
     */
    private $assert_type=NULL; //'NotBool', 'Object', 'NotTrue'...
    
    /**
     *
     * @var string 
     */
    private $result_type=NULL; //'bool', 'object', 'true'...
    
    /**
     *
     * @var mixed 
     */
    private $result_display=NULL;
    
    
    /**
     * Option 
     * @param array $not
     * @return boolean
     */
    static function notTested(array $not)
   {
       self::$option_onlyTested=[];
       
       foreach($not as $item)
           self::$option_notTested[strtolower($item)] = 1;
       return TRUE;
   }
   
   /**
    * Option
    * @param array $only
    * @return boolean
    */
   static function onlyTested(array $only)
   {
       self::$option_notTested=[];
       
       foreach($only as $item)
            self::$option_onlyTested[strtolower($item)] = 1;

       return TRUE;
   }
   
   
   
   /**
    * 
    * @param type $assertion
    * @param type $msg
    */
    function assert_test($assertion, $msg='')
   {
       //OPTIONS
       assert_options(ASSERT_WARNING, 0); 
       assert_options(ASSERT_ACTIVE, 1);

       //BACKTRACE
       $b = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);

       //enleve le suivi qui vient de ce fichier
       for($i=0; $i<5; $i++ )
       {
           if(isset($b[0]['file'])) 
               if(preg_match('#'.__FILE__.'$#', $b[0]['file'])) 
                    array_shift ($b);
       }

       //SET FUNCTION NAME
       if(!isset($b[1]['class'])) $b[1]['class'] = 'noclass'; //No-class function
       $FCT = $b[1]['class'].'::'.$b[1]['function'];
       
       //ONLY tested
       $class_test = strtolower($b[1]['class']);
       $class = preg_replace('/test$/','',$class_test);

       if(!empty(self::$option_onlyTested))
           if(!isset(self::$option_onlyTested[$class])) return;

       //NOT tested
       if(!empty(self::$option_notTested))
           if(isset(self::$option_notTested[$class])) return;

       //FUNCTION
       if(empty(self::$RESULTS[$FCT])) 
           self::$RESULTS[$FCT]=[ 'PASS'=>[], 'FAIL'=>[] ];

       //TESTING message
       $msg = $msg ? '"'.ucfirst($msg).'" - ' : '';
       $type = NULL!==$this->assert_type ?   'Expect '.strtolower($this->assert_type).', ':'';
       $result = NULL!==$this->result_type ? 'got ['.$this->result_type.': '.$this->result_display.'] ':'';
       $file_line = ' at <em>'.$b[0]['file'].':'.$b[0]['line'] . '</em>';
       
       if(!assert($assertion)) 
           self::$RESULTS[$FCT]['FAIL'][] = "$type $result"."$msg $file_line <br/>" . PHP_EOL; //$FCT.'() ' . ' '. 
       else
           self::$RESULTS[$FCT]['PASS'][] = '';
       
       //COUNT
       self::$totalCount++;
       
       //CLEAR
       $this->assert_type=NULL; //'bool', 'object', 'true'...
       $this->result_type=NULL; 
       $this->result_display=NULL;
       
       return TRUE;
   } //assert_test()
   
   
   /**
    * Get results message to display
    * CALL ONLY ONCE
    * 
    * @return type
    */
   static function get_asserts()
   {
       if(self::$get_asserts_already_called) return;
       
        $final_message='<h3>Assert testing</h3>'.PHP_EOL;
        
        $totalCount=0; $count_pass=0; $count_fail=0; $i=0;
        $last_class=NULL;
        
        //pour chaque class::function()
        foreach(self::$RESULTS as $fct => $validated)
        {
            if('globalCount' === $fct) continue;
            $sf = sizeof($validated['FAIL']);
            $sp = sizeof($validated['PASS']);

            $count_pass+=$sp; 
            $count_fail+=$sf; 
            $totalCount = $count_pass+$count_fail;
            
            //new fct called
            //if($b[1]['class'] != self::$last_class_called) $bbr = '<br/>'. PHP_EOL; else $bbr = ''; 
            
            $final_message .= $i ? '<br/>' : '';
            $msg_fail = $sf ? $sf.' failed on ' : '';
            $msg_pass = !$sf ? ' valids' : '';
            $style=' style="color:'. ($sf?'red':'green') . '" ';
            $br = $sf?'<br/>':'';
            $final_message .= '<b '.$style.'>'.$fct . '() - '.$msg_fail.($sp+$sf).' tests '.$msg_pass.'</b>'.$br.PHP_EOL;

            //pour chaque 'FAIL'
            foreach($validated as $pass_fail => $fct_messages)
            {
                //ajoute les messages
                foreach($fct_messages as $fct_m)
                    $final_message .= $fct_m;
            }
            $i++;
        }
        
        //DISPLAY TOTAL
        $s=' width:100%;color:white;background-color:green;padding:3px; ';
        $pass = '<br/><b style="'.$s.'background-color:green;"><u> Total</u>: '.self::$totalCount.' tests valids</b><br/>'.PHP_EOL;
        $fail = '<br/><b style="'.$s.'background-color:red;"><u> Total</u>: '.
                $count_fail. ' failed tests on '.self::$totalCount.' </b><br/>'.PHP_EOL;

        $final_message .= '<br/>';
        if(self::$totalCount !== $totalCount) 
            $final_message .= 'Total des tests invalide!';
        else 
            $final_message .= self::$totalCount === $count_pass ? $pass : $fail;
        
        self::$get_asserts_already_called=TRUE;
        return $final_message;

   }
   
   
   /**
    * @param mixed $assertion
    * @param string $msg
    */
   function assertTrue($assertion, $msg=''){ $this->_set_testing('True', TRUE===$assertion, $assertion, $msg); }
   function assertNotTrue($assertion, $msg=''){ $this->_set_testing('NotTrue', TRUE!==$assertion, $assertion, $msg); }
   function assertFalse($assertion, $msg=''){ $this->_set_testing('False', FALSE===$assertion, $assertion, $msg); }
   function assertNotFalse($assertion, $msg=''){ $this->_set_testing('NotFalse', FALSE!==$assertion, $assertion, $msg); }
   function assertNull($assertion, $msg=''){ $this->_set_testing('Null', NULL===$assertion, $assertion, $msg); }
   function assertNotNull($assertion, $msg=''){ $this->_set_testing('NotNull', NULL!==$assertion, $assertion, $msg); }
   function assertBool($assertion, $msg=''){ $this->_set_testing('Bool', is_bool($assertion), $assertion, $msg); }
   function assertNotBool($assertion, $msg=''){ $this->_set_testing('NotBool', !is_bool($assertion), $assertion, $msg); }
   function assertString($assertion, $msg=''){ $this->_set_testing('String', is_string($assertion), $assertion, $msg); }
   function assertNotString($assertion, $msg=''){ $this->_set_testing('NotString', !is_string($assertion), $assertion, $msg); }
   function assertArray($assertion, $msg=''){ $this->_set_testing('Array', is_array($assertion), $assertion, $msg); }
   function assertNotArray($assertion, $msg=''){ $this->_set_testing('NotArray', !is_array($assertion), $assertion, $msg); }
   function assertInteger($assertion, $msg=''){ $this->_set_testing('Int', is_integer($assertion), $assertion, $msg); }
   function assertNotInteger($assertion, $msg=''){ $this->_set_testing('NotInt', !is_integer($assertion), $assertion, $msg); }
   function assertObject($assertion, $msg=''){ $this->_set_testing('Object', is_object($assertion), $assertion, $msg); }
   function assertNotObject($assertion, $msg=''){ $this->_set_testing('NotObject', !is_object($assertion), $assertion, $msg); }
   
   function assertInstanceOf($instance, $assertion, $msg=''){ $this->_set_testing('InstanceOf', is_a($assertion, $instance), $assertion, $msg); }
   function assertNotInstanceOf($instance, $assertion, $msg=''){ $this->_set_testing('NotInstanceOf', !is_a($assertion, $instance), $assertion, $msg); }
   function assertEquals($assertion2, $assertion, $msg=''){ $this->_set_testing('Equal', $assertion===$assertion2, $assertion, $msg); }
   function assertNotEquals($assertion2, $assertion, $msg=''){ $this->_set_testing('NotEqual', $assertion!==$assertion2, $assertion, $msg); }
   function assertSame($assertion2, $assertion, $msg=''){ $this->_set_testing('Same', $assertion===$assertion2, $assertion, $msg); }
   function assertNotSame($assertion2, $assertion, $msg=''){ $this->_set_testing('NotSame', $assertion!==$assertion2, $assertion, $msg); }
   function assertRegExp($pattern, $assertion, $msg=''){ $this->_set_testing('RegExp', preg_match($pattern, $assertion), $assertion, $msg); }
   function assertNotRegExp($pattern, $assertion, $msg=''){ $this->_set_testing('NotRegExp', !preg_match($pattern, $assertion), $assertion, $msg); }
   
   
   /**
    * Constraint
    */
   //function greaterThan($value) {  }
   
   /**
    * 
    * @param type $type
    * @param type $test_assertion
    * @param type $assertion
    * @param type $msg
    */
   private function _set_testing($type, $test_assertion, $assertion, $msg)
   {
       //SET BEFORE
       $this->assert_type = $type;
       $this->result_type = gettype($assertion); 
       $this->result = $assertion;
       
       if(NULL===$assertion) {$this->result_type='Null'; $this->result_display='Null';}
       elseif(is_bool($assertion)) {$this->result_type='Boolean'; $this->result_display=$assertion?'True':'False';}
       elseif(is_string($assertion)) {$this->result_type='String'; $this->result_display=substr($assertion,0,30).'...';}
       elseif(is_integer($assertion)) {$this->result_type='Integer'; $this->result_display=(string)$assertion.'';}
       elseif(is_object($assertion)) {$this->result_type='Object'; $this->result_display=get_class($assertion);}
       elseif(is_array($assertion)) {$this->result_type='Array'; $this->result_display='Size:'.sizeof($assertion);}
       elseif(is_a($assertion, $test_assertion)) $this->result_type='Instance of '.get_class($assertion);
       
       //launch
       $this->assert_test($test_assertion, $msg); 
   }
   
   
   
   
   
   
   
   
   
   
   
   
   /*****************************************************************
     * 
     *                          FOR EXTENDED CLASS
     * 
     *************************************************************/
   
   /**
    *
    * @var boolean 
    */
   protected $constructorArgs = NULL;
           
   /**
    * 
    * @param type $run
    */
   function __construct($run=FALSE)
   {
       if($run) $this->run();
   }
   
   public function setUpBeforeClass() { }
   protected function setUp() { }
   protected function assertPreConditions() {}
   protected function assertPostConditions() {}
   protected function tearDown() { }
   public function tearDownAfterClass() { }

   
    function run() //$sTestClassName)
   {
            try {
            $a = new ReflectionClass($this);
           //$sClassName = preg_replace('/Test$/','', $a->name);
           $sTestClassName = $a->name;

           $aSelfTestMethods = get_class_methods ( $sTestClassName );
           $sClassName = preg_replace ( '/Test$/','',$sTestClassName );

           $aTestMethods = [];
           //$aProviderMethods = [];
           foreach($aSelfTestMethods as $sAllMethodName)
           {
               //if(preg_match('/Provider$/',$sAllMethodName))
               //    $aProviderMethods[$sAllMethodName] = $this->$sAllMethodName();

               if(preg_match('/^test/',$sAllMethodName))
                   $aTestMethods[] = $sAllMethodName;
           }

           //run test methods
           $this->setUpBeforeClass();
           foreach($aTestMethods as $sMethod)
           {
               $this->setUp();

               $c=NULL;
               if(NULL !== $this->constructorArgs)
               {
                   $reflector = new ReflectionClass($sClassName);
                   $c = $reflector->newInstanceArgs($this->constructorArgs);
                   $this->$sClassName = $reflector->newInstanceArgs($this->constructorArgs);
                    //$c = new $sClassName();
                    //$this->$sClassName = new $sClassName();
               }
               else {
                   //$c = new $sClassName();
                   //$this->$sClassName = new $sClassName();
               }

               //PROVIDER
               $this->$sMethod( $c );

               $this->tearDown();
           }

           $this->tearDownAfterClass();
        } catch( Exception $e) { echo $e; }
   }
   
   
   function getMock($class_name /* string interface_name, i_n2 ... */) 
   {
        StdMock_Utils::assertString($class_name);
        $interface_names = func_get_args();
        array_shift($interface_names);
        
        return StdMock_Config::get()
          ->getMockCreator()
          ->createMock($class_name, $interface_names);
   }
   
   /**
    * 
    * @param class &$s
    * @param string $property_name
    * @param string $value
    * @return 
    * 
    */
   function setPrivateProperty(&$class, $property_name, $value)
   {
        $property = new ReflectionProperty($class, $property_name);
        $property->setAccessible( TRUE );
        if($property->setValue($class, $value)) return TRUE;
        return FALSE;
   }
   
   /**
    * 
    * @param object &$s
    * @param string $method_name
    * @param array $args
    * @return mixed
    */
   function callPrivateMethod(&$class, $method_name, array $args=[])
   {
        return $this->invokeMethod($class, $method_name, $args);
   }
   
   /**
    * 
    * @param object $class
    * @param string $method
    * @param array $args
    * @return type
    */
   function invokeMethod(&$class, $method_name, array $args=[])
    {
        $methodr = new ReflectionMethod($class, $method_name);
        $methodr->setAccessible(TRUE);
        return $methodr->invokeArgs($class, $args);
    }
   
    
} //CLASS




/**
 * https://phpunit.de/manual/6.5/en/appendixes.assertions.html
 * 
 * There was 1 failure:

1) TemplateMethodsTest::testTwo
Failed asserting that <boolean:false> is true.
/home/sb/TemplateMethodsTest.php:30

FAILURES!
Tests: 2, Assertions: 2, Failures: 1.
 */

/**
 * 
 * Class DebugReflexion
 *
 */
/*class DebugReflexion {
    
    /**
     * Get property value
     *
    static function getPropertyValue($class, $property_name)
    {
        if(!is_string($class)) {throw new Exception('Param @class must be a string, '.gettype($class).' gived instead.' ); return FALSE;}
        if(!class_exists($class)) {throw new Exception('@class must exists'); return FALSE;}
        
        $propertyR = new ReflectionProperty($class, $property_name);
        $propertyR->setAccessible(TRUE);
        $v = $propertyR->getValue(new $class());
        return $v;
    }
    
    /**
     * Get property value
     *
    static function getReflexionClass($class)
    {
        if(!is_string($class)) {throw new Exception('Param @class must be a string, '.gettype($class).' gived instead.' ); return FALSE;}
        if(!class_exists($class)) {throw new Exception('@class must exists'); return FALSE;}
        
        $classR = new ReflectionClass($class);
        return $classR;
    }
    
    /**
     * Se property value
     *
    static function setPropertyValue($class, $property_name, $value)
    {
        if(!is_string($class)) {throw new Exception('Param @class must be a string, '.gettype($class).' gived instead.' ); return FALSE;}
        if(!class_exists($class)) {throw new Exception('@class must exists'); return FALSE;}
        
        $propertyR = new ReflectionProperty($class, $property_name);
        $propertyR->setAccessible(TRUE);
        $v = $propertyR->setValue(new $class(), $value);
        return $v;
    }
    
    
    static function invokeMethod($class, $method, array $args=[NULL])
    {
        if(!is_string($class)) {throw new Exception('Param @class must be a string, '.gettype($class).' gived instead.' ); return FALSE;}
        if(!class_exists($class)) {throw new Exception('@class must exists'); return FALSE;}

        $methodR = new ReflectionMethod($class, $method);
        $methodR->setAccessible(TRUE);
        $res = $methodR->invokeArgs(new $class(), $args);
        return $res;
    }
}

*/

/**
 *         assertArrayHasKey()
        assertClassHasAttribute()
        assertArraySubset()
        assertClassHasStaticAttribute()
        assertContains()
        assertContainsOnly()
        assertContainsOnlyInstancesOf()
        assertCount()
        assertDirectoryExists()
        assertDirectoryIsReadable()
        assertDirectoryIsWritable()
        assertEmpty()
        assertEqualXMLStructure()
        assertFileEquals()
        assertFileExists()
        assertFileIsReadable()
        assertFileIsWritable()
        assertGreaterThan()
        assertGreaterThanOrEqual()
        assertInfinite()
        assertInstanceOf()
        assertInternalType()
        assertIsReadable()
        assertIsWritable()
        assertJsonFileEqualsJsonFile()
        assertJsonStringEqualsJsonFile()
        assertJsonStringEqualsJsonString()
        assertLessThan()
        assertLessThanOrEqual()
        assertNan()
        assertObjectHasAttribute()
        assertRegExp()
        assertStringMatchesFormat()
        assertStringMatchesFormatFile()
        assertStringEndsWith()
        assertStringEqualsFile()
        assertStringStartsWith()
        assertThat()
        assertXmlFileEqualsXmlFile()
        assertXmlStringEqualsXmlFile()
        assertXmlStringEqualsXmlString()
    
Time: 0 seconds, Memory: 5.00Mb

 */