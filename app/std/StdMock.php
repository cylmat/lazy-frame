<?php

/**
 * Class StdMock
 * 
 * Come from FBMock library
 * https://github.com/facebookarchive/FBMock
 * 
 * @package    StdMock
 * @copyright  Copyright (c) Url (fr) 2018
 * @license    http://creativecommons.org/licenses/by/2.0/fr/ Creative Commons
 * 
 */

/*By default, all methods return null. Helper methods for configuring return values are prefixed with 'mock'.

mock('Foo')->mockReturn('bar', 'return value here');

mock('Foo')->mockImplementation(
    'bar',
    function ($bar_type) {
        return $bar_type == 1;
    }
);

$mock_foo = mock('Foo');
$mock->mockReturn('bar', 1);
    ->mockReturnThis($method1 , $method2, );
    ->mockThrow($method_name, Exception $e);
    ->mockGetCalls($method_name);

$code_under_test->doSomething($mock_foo);

// Returns array of calls
$mock_foo->mockGetCalls('bar');

$this->assertCalledOnce($mock_foo, 'bar');
$this->assertCalledOnce($mock_foo, 'bar', $expected_params_as_array); // param assertion is optional
$this->assertCalls($mock_foo, 'bar', $expected_params_for_first_call, $expected_params_for_second_call, ...);

mock('Foo')->mockReturn(array(
    'bar' => 1,
    'get' => 'data',
    'run' => true,
))->mockReturnThis('set', 'addID', 'removeID');

mock('Foo')
    ->mockReturn('bar', 1)
    ->mockThrow('other_method')
    ->mockImplementation('another_method', function () { // })
    ->mockReturnThis('setData');
*/



/**
 * class StdMock
 */
class StdMock_Config extends FBMock_Config {}
class StdMock_Utils extends FBMock_Utils {}
//end







/**
 * Create a mock object of type $class_name.
 *
 * All unmocked methods will return null.
 */
/*function mock($class_name /* string interface_name, i_n2 ... *) {
  FBMock_Utils::assertString($class_name);
  $interface_names = func_get_args();
  array_shift($interface_names);
  return FBMock_Config::get()
    ->getMockCreator()
    ->createMock($class_name, $interface_names);
}*/

/**
 * Create a strict mock object of type $class_name.
 *
 * "Strict" means that if any unmocked method is called, an exception will be
 * thrown.
 */
/*function strict_mock($class_name /* string interface_name, i_n2 ... *) {
  FBMock_Utils::assertString($class_name);
  $interface_names = func_get_args();
  array_shift($interface_names);
  return FBMock_Config::get()
    ->getMockCreator()
    ->createStrictMock($class_name, $interface_names);
}*/

/********************************************************************************
 * 
 *                              FBMock_Mock
 * 
 */

/**
 * Public API for configuring mock objects.
 */
interface FBMock_Mock {
  /**
   * Force the given method(s) to always return a value
   *
   * @param  $method_name  Name of method
   * @param  $value        Value to return
   *
   *   OR
   *
   * @param  $method_names_to_values   map of method names to their return
   *                                   values
   * @return $this
   */
  public function mockReturn(/*...*/);

  /**
   * Replace the implementation of a method with a closure
   *
   * @param  $method_name  Name of method to replace
   * @param  $callable     New implementation of method.  Can be a Closure,
   *                       string, array(obj, method), etc.
   * @return $this
   */
  public function mockImplementation($method_name, $callable);

  /**
   * Force the given method(s) to return $this to allow chaining
   *
   * @param  ...   method names
   * @return $this
   */
  public function mockReturnThis($method1 /** $method2, ... */);

  /**
   * Throw exception when method is called
   *
   * @param  $method_name  name of method
   * @param  $e            exception to throw
   * @return $this
   */
  public function mockThrow($method_name, Exception $e);

  /**
   * Returns an array representing the invocations of $method_name in the
   * following form:
   *
   * array(
   *   array($param1, $param2, $param3 ...) // first invocation
   *   array($param1, $param2, $param3 ...) // second invocation
   * )
   *
   * Note: see MockAssertionHelpers which has helper methods for asserting
   * calls in tests.
   *
   * @param   $method_name   name of method to get calls for
   * @return  array of invocations
   */
  public function mockGetCalls($method_name);
}










/********************************************************************************
 * 
 *                              FBMock_Config
 * 
 */
/**
 * Uncomment this class and move it to CustomConfig.php to use your own custom
 * configuration for FBMock
 */

/*
class FBMock_CustomConfig extends FBMock_Config {
  public function getDoubleCreator() {
    // Return custom subclass of FBMock_TestDoubleCreator
    return new CustomTestDoubleCreator();
  }

  public function getClassGenerator() {
    // Return custom subclass of FBMock_TestDoubleClassGenerator for doing
    // codegen of mock classes
    return new CustomTestDoubleClassGenerator();
  }

  public function getExtraMockTraits() {
    // Extra traits that will be added to mock objects. This allows adding new,
    // custom configuration methods to the mocks
    return array('CustomMockObject');
  }
}
*/

class FBMock_Config {
  /**
   * Get object responsible for creating mock objects
   *
   * @return  FBMock_MockCreator or subclass
   */
  public function getMockCreator() {
    return new FBMock_MockCreator();
  }

  /**
   * Get object responsible for doing codegen for test doubles
   *
   * @return  FBMock_TestDoubleClassGenerator or subclass
   */
  public function getClassGenerator() {
    return new FBMock_TestDoubleClassGenerator();
  }

  public function getMethodGenerator() {
    return new FBMock_TestDoubleMethodGenerator();
  }

  public function getTestDoubleCreator() {
    return new FBMock_TestDoubleCreator();
  }

  /**
   * Get list of traits to add to mocks
   *
   * @return   array   names of traits
   */
  public function getMockTraits() {
    return array('FBMock_MockObject');
  }

  public function createMockImplementation($class_name) {
    return new FBMock_MockImplementation($class_name);
  }

  private static $config;

  public final static function get() {
    if (!self::$config) {
      $custom_config_path = __DIR__.'/CustomConfig.php';
      if (file_exists($custom_config_path)) {
        require_once $custom_config_path;
        self::$config = new FBMock_CustomConfig();
      } else {
        self::$config = new FBMock_Config();
      }
    }
    return self::$config;
  }

  public final static function setConfig(FBMock_Config $config) {
    self::$config = $config;
  }

  public final static function clearConfig() {
    self::$config = null;
  }
}






/********************************************************************************
 * 
 *                              FBMock_MockCreator
 * 
 */
class FBMock_MockCreator {
    
  public final function createMock($class_name, $extra_interfaces = array()) {
    FBMock_Utils::assertString($class_name);
    list($interface_names, $trait_names) =
      FBMock_Utils::getInterfacesAndTraits($extra_interfaces);
    $double = FBMock_Config::get()->getTestDoubleCreator()->createTestDoubleFor(
      $class_name,
      $interface_names,
      $trait_names,
      function (ReflectionClass $class, ReflectionMethod $method) {
        if (strpos($method->getName(), 'mock') === 0) {
          throw new FBMock_MockObjectException(
            '%s cannot be mocked because it has a method name that starts '.
            'with "mock": %s. Methods named mock____ are reserved for '.
            'configuring mock objects.',
            $class->getName(),
            $method->getName()
          );
        }
      }
    );
    FBMock_Utils::setDoubleImplementation(
      $double,
      FBMock_Config::get()->createMockImplementation($class_name)
    );

    $this->postCreateHandler($double);

    return $double;
  }

  public final function createStrictMock(
      $class_name,
      $extra_interfaces = array()) {
    FBMock_Utils::assertString($class_name);
    $mock = self::createMock($class_name, $extra_interfaces);
    FBMock_Utils::getDoubleImplementation($mock)->setStrictMock();
    return $mock;
  }

  // Override to add custom logic to mocks after they are created
  protected function postCreateHandler($double) { }
}



/********************************************************************************
 * 
 *                              FBMock_MockImplementation
 * 
 */
class FBMock_MockImplementation {
  private
    $className,
    $isStrictMock = false,
    $methodsToStubs = array(),
    $methodsToCalls = array();

  public function __construct($class_name) {
    FBMock_Utils::assertString($class_name);
    $this->className = $class_name;
  }

  public function setImplementation($double, $method, $callable) {
    FBMock_Utils::assertString($method);
    $this->assertMethodExists($double, $method);

    // HHVM doesn't support Callable typehint yet
    FBMock_Utils::enforce(is_callable($callable), 'Must pass a callable');

    $this->methodsToStubs[strtolower($method)] = $callable;
    return $this;
  }

  public function getCalls($double, $method) {
    FBMock_Utils::assertString($method);
    $this->assertMethodExists($double, $method);
    if ($this->isStrictMock) {
      FBMock_Utils::enforce(
        $this->getStub($method),
        "Trying to fetch calls for unmocked method %s on strict mock of %s",
        $method,
        $this->className
      );
    }

    if (isset($this->methodsToCalls[strtolower($method)])) {
      return $this->methodsToCalls[strtolower($method)];
    }

    return array();
  }

  public function processMethodCall($double, $method, array $args = array()) {
    FBMock_Utils::assertString($method);
    $this->assertMethodExists($double, $method);
    $this->methodsToCalls[strtolower($method)][] = $args;

    $stub = $this->getStub($method);
    if ($stub) {
      return call_user_func_array($stub, $args);
    } else if ($this->isStrictMock) {
      throw new FBMock_MockObjectException(
        'Unmocked method %s called on strict mock of %s',
        $method,
        $this->className
      );
    }
    return null;
  }

  public function setStrictMock() {
    $this->isStrictMock = true;
    return $this;
  }

  protected function assertMethodExists($double, $method_name) {
    FBMock_Utils::assertString($method_name);

    // If they've implemented __call, we have no idea if this method is legit
    if (method_exists($double, '__call')) {
      return;
    }

    $method_exists = method_exists($double, $method_name);
    if ($method_exists) {
      $ref_method = new ReflectionMethod($double, $method_name);
      $real_name = $ref_method->getName();
      if ($real_name != $method_name) {
        throw new FBMock_MockObjectException(
          'Method "%s" does not exist for %s. Did you mean %s? The mocks '.
            'framework is case sensitive',
          $method_name,
          $this->className,
          $real_name
        );
      }
    }
    if (!$method_exists) {
      throw new FBMock_MockObjectException(
        'Method "%s" does not exist for %s',
        $method_name,
        $this->className
      );
    }
  }

  private function getStub($method_name) {
    FBMock_Utils::assertString($method_name);
    if (isset($this->methodsToStubs[strtolower($method_name)])) {
      return $this->methodsToStubs[strtolower($method_name)];
    }

    return null;
  }
}


/********************************************************************************
 * 
 *                              FBMock_MockObject
 * 
 */
/**
 * Adds methods to a mock object for configuring its return values and spying
 * on method calls.
 *
 * All methods should be prefixed with "mock" to avoid collisions with other
 * methods on the object being mocked.
 *
 * See Mock interface for documentation.
 */
trait FBMock_MockObject { // implements Mock
  public function mockReturn(/* ... */) {
    $args = $this->mockAssertMultiArgs(func_get_args(), __METHOD__);

    if (count($args) == 1) {
      foreach ($args[0] as $method_name => $value) {
        FBMock_Utils::assertString($method_name);
        $this->__mockReturn($method_name, $value);
      }
      return $this;
    }

    return $this->__mockReturn($args[0], $args[1]);
  }

  private function mockAssertMultiArgs($args, $method_name) {
    FBMock_Utils::assertString($method_name);
    if (count($args) == 0 || count($args) > 2) {
      throw new FBMock_MockObjectException(
        "$method_name expects method name and return value or map of method ".
        "names to return values"
      );
    }

    return $args;
  }

  private function __mockReturn($method_name, $value) {
    FBMock_Utils::assertString($method_name);
    return $this->mockImplementation($method_name, function() use ($value) {
      return $value;
    });
  }

  public function mockImplementation($method_name, $callable) {
    FBMock_Utils::assertString($method_name);

    FBMock_Utils::getDoubleImplementation($this)
      ->setImplementation($this, $method_name, $callable);

    return $this;
  }

  public function mockReturnThis($method1 /** $method2, ... */) {
    $that = $this;
    foreach (func_get_args() as $method_name) {
      FBMock_Utils::assertString($method_name);
      $this->mockImplementation(
        $method_name,
        function() use ($that) {
          return $that;
        }
      );
    }
    return $this;
  }

  public function mockThrow($method_name, Exception $e) {
    FBMock_Utils::assertString($method_name);
    return $this->mockImplementation(
      $method_name,
      function() use ($e) {
        throw $e;
      }
    );
  }

  public function mockGetCalls($method_name) {
    FBMock_Utils::assertString($method_name);
    return FBMock_Utils::getDoubleImplementation($this)->getCalls($this, $method_name);
  }
}


/********************************************************************************
 * 
 *                              FBMock_MockObjectException
 * 
 */
class FBMock_MockObjectException extends Exception {
  public function __construct($format_str /* $arg1, $arg2 */) {
    FBMock_Utils::assertString($format_str);
    $args = array_slice(func_get_args(), 1);
    parent::__construct(vsprintf($format_str, $args));
  }
}

/********************************************************************************
 * 
 *                              FBMock_AssertionHelpers
 * 
 */
/**
 * Helper asserts for mocks. Add to your base PHPUnit\Framework\TestCase.
 */
trait FBMock_AssertionHelpers {
  /**
   * Assert that the method was called a certain number of times on a mock
   *
   * @param  $mock                a mock object
   * @param  $method_name         name of method to check
   * @param  $expected_num_calls  expected number of calls
   * @param  $msg                 message for assert (optional)
   */
  public static function assertNumCalls(
      FBMock_Mock $mock,
      $method_name,
      $expected_num_calls,
      $msg = '') {
    FBMock_Utils::assertString($method_name);
    FBMock_Utils::assertInt($expected_num_calls);
    $call_count = count($mock->mockGetCalls($method_name));
    PHPUnit\Framework\TestCase::assertEquals(
      $expected_num_calls,
      $call_count,
      $msg ?: "$method_name called wrong number of times"
    );
  }

  /**
   * Assert that the method was called once. If $args is given, check that it
   * matches the args $method_name was called with.
   *
   * @param  $mock         a mock object
   * @param  $method_name  name of method to check
   * @param  $args         expected arguments (optional)
   * @param  $msg          message for assert (optional)
   */
  public static function assertCalledOnce(
      FBMock_Mock $mock,
      $method_name,
      $args=null,
      $msg='') {
    FBMock_Utils::assertString($method_name);
    self::assertNumCalls($mock, $method_name, 1, $msg);

    if ($args !== null) {
      PHPUnit\Framework\TestCase::assertEquals(
        $args,
        $mock->mockGetCalls($method_name)[0],
        $msg ?: "$method_name args are not equal"
      );
    }
  }

  /**
   * Assert that the method was not called.
   *
   * @param  $mock         a mock object
   * @param  $method_name  name of method to check
   * @param  $msg          message for assert (optional)
   */
  public static function assertNotCalled(
      FBMock_Mock $mock,
      $method_name,
      $msg='') {
    FBMock_Utils::assertString($method_name);
    self::assertNumCalls($mock, $method_name, 0, $msg);
  }

  /**
   * Assert that the method calls match the array of calls.
   *
   * Example usage:
   *
   *    // Code under test calls method
   *    $mock->testMethod(1,2,3);
   *    $mock->testMethod('a', 'b', 'c');
   *
   *    // Test asserts calls
   *    self::assertCalls(
   *      $mock,
   *      'testMethod',
   *      array(1,2,3),
   *      array('a', 'b', 'c')
   *    );
   *
   * @param  $mock         a mock object
   * @param  $method_name  name of method to check
   * @param  ...           arrays of expected arguments for each call
   * @param  $msg          message for assert (optional)
   */
  public static function assertCalls(
      FBMock_Mock $mock,
      $method_name
      /* array $expected_first_call, array $expected_second_call, $msg = ''*/) {

    FBMock_Utils::assertString($method_name);
    $args = func_get_args();
    $msg = '';
    if (is_string(end($args))) {
      $msg = array_pop($args);
    }

    $expected_calls = array_slice($args, 2);
    self::assertNumCalls($mock, $method_name, count($expected_calls), $msg);

    $actual_calls = $mock->mockGetCalls($method_name);
    foreach ($expected_calls as $i => $call) {
      PHPUnit\Framework\TestCase::assertEquals(
        $call,
        $actual_calls[$i],
        $msg ?: "Call $i for method $method_name did not match expected call"
      );
    }
  }
}




/********************************************************************************
 * 
 *                              FBMock_Utils
 * 
 */
class FBMock_Utils {
  public static function mockClassNameFor(
      $class_name,
      array $interfaces,
      array $traits) {

    self::assertString($class_name);

    sort($interfaces);
    sort($traits);

    return sprintf(
      'FBMockFramework_%s_%s_%s',
      self::classNameForMock($class_name),
      implode('_', (array)str_replace('_', '__', $interfaces)),
      implode('_', (array)str_replace('_', '__', $traits))
    );
  }

  public static function isHHVM() {
    return defined('HPHP_VERSION');
  }

  public static function getInterfacesAndTraits(array $interfaces = array()) {
    $interfaces[] = 'FBMock_Mock';
    return array(
      $interfaces,
      FBMock_Config::get()->getMockTraits(),
    );
  }

  public static function enforce($invariant, $msg /* args */) {
    if (!$invariant) {
      self::assertString($msg);

      // TODO (#1913833): use FBMock_MockObjectException
      throw new Exception(vsprintf($msg, array_slice(func_get_args(), 2)));
    }
  }

  public static function assertString($str) {
    if (!is_string($str)) {
      throw new InvalidArgumentException(
        "String argument expected, ".gettype($str)." given"
      );
    }
  }

  public static function assertInt($int) {
    if (!is_int($int)) {
      throw new InvalidArgumentException(
        "Integer argument expected, ".gettype($int)." given"
      );
    }
  }

  public static function setDoubleImplementation($double, $impl) {
    $double->__implementation = $impl;
  }

  public static function getDoubleImplementation($double) {
    return $double->__implementation;
  }

  public static function classNameForMock($class_name) {
    // Remove namespace separators from class name as mocks are not namespaced.
    return str_replace('\\', '__NS__', $class_name);
  }
}








/********************************************************************************
 * 
 *                              FBMock_TestDoubleClassGenerator
 * 
 */
/**
 * Generate code for a mock version of a class
 */
class FBMock_TestDoubleClassGenerator {
  public final function generateCode(
      ReflectionClass $class,
      $test_double_class_name,
      array $interfaces = array(),
      array $traits = array(),
      $method_checker = null) {

    FBMock_Utils::assertString($test_double_class_name);
    if ($class->isFinal() && !$this->canOverrideFinals()) {
      throw new FBMock_TestDoubleException(
        "Cannot mock final class %s",
        $class->getName()
      );
    }

    $code = $this->getMockClassHeader(
      $class,
      $test_double_class_name,
      $interfaces,
      $traits
    ) . "\n";

    $method_sources = array();

    foreach ($class->getMethods() as $method) {
      $method_checker && $method_checker($class, $method);

      if ($method->isFinal() && !$this->canOverrideFinals()) {
        continue;
      }

      // #1137433
      if (!$class->isInterface()) {
        $method = new ReflectionMethod($class->getName(), $method->getName());
      }
      $test_double_method_generator =
        FBMock_Config::get()->getMethodGenerator();
      $method_source = $test_double_method_generator->generateCode($method);
      if ($method_source) {
        $method_sources[] = $method_source;
      }
    }

    $code .= implode("\n\n", $method_sources);
    $code .= "\n}"; // close class

    return $code;
  }

  public final function getMockClassHeader(
      ReflectionClass $class,
      $test_double_class_name,
      array $interfaces,
      array $traits) {

    $extends = '';
    if ($class->isInterface()) {
      $interfaces[] = $class->getName();
    } else {
      $extends = 'extends '.$class->getName();
    }

    $interfaces_str =
      $interfaces ? 'implements '.implode(', ', $interfaces) : '';

    $traits []= 'FBMock_TestDoubleObject';
    $traits_str = 'use '.implode(', ', $traits).';';

    $doc_block = '';
    if (FBMock_Utils::isHHVM()) {
      // Allows mocking final classes and methods.
      // CAUTION: this implementation is subject to change, avoid using outside
      // of FBMock
      $doc_block = '<< __MockClass >>';
    }

    return sprintf(<<<'EOT'
%s
class %s %s %s {
  %s
EOT
      ,
      $doc_block,
      $test_double_class_name,
      $extends,
      $interfaces_str,
      $traits_str
    );
  }

  protected function assertNotFinal(ReflectionClass $c) {
    if ($c->isFinal()) {
      throw new FBMock_TestDoubleException(
        "Cannot mock final class %s",
        $c->getName()
      );
    }
  }

  private function canOverrideFinals() {
    return FBMock_Utils::isHHVM();
  }
}

// Hack - if we include this property directly on the class, it'll show up
// if someone foreach's a mock but it doesn't if we put it in a trait
trait FBMock_TestDoubleObject {
  public $__implementation;
}



/********************************************************************************
 * 
 *                              FBMock_TestDoubleCreator
 * 
 */
class FBMock_TestDoubleCreator {
  public final function createTestDoubleFor(
      $class_name,
      array $interfaces = array(),
      array $traits = array(),
      $method_checker = null) {

    FBMock_Utils::assertString($class_name);
    $this->assertAllowed();

    if (!class_exists($class_name) && !interface_exists($class_name)) {
      throw new FBMock_TestDoubleException(
        "Attempting to mock $class_name but $class_name isn't loaded."
      );
    }

    $mock_class_name = FBMock_Utils::mockClassNameFor(
      $class_name,
      $interfaces,
      $traits
    );

    $ref_class = new ReflectionClass($class_name);

    if ($ref_class->isInternal() && !FBMock_Utils::isHHVM()) {
      throw new FBMock_TestDoubleException(
        "Trying to mock PHP internal class $class_name. Mocking of internal ".
        "classes is only supported in HHVM."
      );
    }

    if (!class_exists($mock_class_name, $autoload = false)) {
      $class_generator_class = FBMock_Config::get()->getClassGenerator();
      $class_generator = new $class_generator_class();
      $code = $class_generator->generateCode(
        $ref_class,
        $mock_class_name,
        $interfaces,
        $traits,
        $method_checker
      );

      eval($code);
    }

    $mock_object = (new ReflectionClass($mock_class_name))
      ->newInstanceWithoutConstructor();

    return $mock_object;
  }

  // Hook to disallow doubles in certain cases (such as prod)
  protected function assertAllowed() {}
}

/********************************************************************************
 * 
 *                              FBMock_TestDoubleException
 * 
 */
class FBMock_TestDoubleException extends Exception {
  public function __construct($format_str /* $arg1, $arg2 */) {
    FBMock_Utils::assertString($format_str);
    $args = array_slice(func_get_args(), 1);
    parent::__construct(vsprintf($format_str, $args));
  }
}


/********************************************************************************
 * 
 *                              FBMock_TestDoubleMethodGenerator
 * 
 */
/**
 * Generate code for a single method on a mock object
 */
class FBMock_TestDoubleMethodGenerator {
  public function generateCode(ReflectionMethod $method) {
    $func_name = '__FUNCTION__';
    $args = 'func_get_args()';

    if ($method->getName() == '__call') {
      $func_name = 'func_get_args()[0]';
      $args = 'func_get_args()[1]';
    }

    if ($method->isStatic()) {
      $method_body = sprintf(
        "throw new FBMock_TestDoubleException('Call to static method %s on ".
        "%s. Mocks and fakes don\'t support static methods');",
        $method->getName(),
        $method->getDeclaringClass()->getName()
      );
    } else {
      $method_body = sprintf(
        'return $this->__implementation->processMethodCall($this, %s, %s);',
        $func_name,
        $args
      );
    }

    $code = sprintf(
      "%s {\n  %s\n}",
      $this->getMethodHeader($method),
      $method_body
    );

    return $code;
  }

  // public for testing
  public final function getMethodHeader(ReflectionMethod $method) {
    $param_sources = array();
    foreach ($method->getParameters() as $param) {
      $param_sources[] = $this->generateParameterCode($param);
    }

    if ($method->isProtected()) {
      $modifier = 'protected';
    } else if ($method->isPrivate()) {
      $modifier = 'private';
    } else {
      $modifier = 'public';
    }

    return sprintf(
      '%s %sfunction %s(%s)',
      $modifier,
      $method->isStatic() ? 'static ' : '',
      $method->getName(),
      implode(', ', $param_sources)
    );
  }

  public final function generateParameterCode(ReflectionParameter $param) {
    $code = '';

    $typehint_type = $this->getParameterTypehint($param);
    if ($typehint_type) {
      $code .= $typehint_type.' ';
    }
    if($param->isPassedByReference()) {
      $code .= '&$'.$param->getName();  
    } else {
      $code .= '$'.$param->getName();  
    }
    

    if ($param->isDefaultValueAvailable()) {
      $code .= '='.$this->getDefaultParameterValue($param);
    }

    return $code;
  }

  private function getParameterNames(ReflectionMethod $method) {
    $param_names = array();
    foreach ($method->getParameters() as $param) {
      $param_names[] = "'".$param->getName()."'";
    }
    return 'array('.implode(', ', $param_names).')';
  }

  private function getDefaultParameterValue(ReflectionParameter $param) {
    if (method_exists($param, 'getDefaultValueText')) {  // HHVM-only
      return $param->getDefaultValueText();
    }

    return var_export($param->getDefaultValue(), true);
  }

  protected function getParameterTypehint(ReflectionParameter $param) {
    // HHVM-only (primitive typehints)
    if (method_exists($param, 'getTypehintText')) {
      return $param->getTypehintText();
    }

    if ($param->getClass()) {
      return $param->getClass()->getName();
    }

    if ($param->isArray()) {
      return 'array';
    }

    return '';
  }
}




/*
 * FBMock

FBMock is a PHP mocking framework designed to be simple and easy to use.

Unlike other mocking frameworks, FBMock is basically just stubs with spies. Instead of using a custom DSL and relying on opaque tear-down verification, FBMock encourages developers to program simple return behaviors and only use spies when appropriate.
Requirements

    HHVM or PHP 5.4+

Note: the framework's tests use PHPUnit but PHPUnit is not necessary for using FBMock.
Usage

Include init.php which sets up the autoloader

require_once YOUR_FBMOCKS_DIR.'/init.php'

Install using Composer (optional)

To install this package via composer, just add the package to require and start using it.

{
    "require": {
        "facebook/fbmock": "*@dev"
    }
}

Creating a mock

mock('Foo')

Also, you can mock an interface in the same manner:

mock('IFoo')

Stubbing

By default, all methods return null. Helper methods for configuring return values are prefixed with 'mock'.

mock('Foo')->mockReturn('bar', 'return value here');

Sometimes, you need more control than mockReturn:

mock('Foo')->mockImplementation(
    'bar',
    function ($bar_type) {
        return $bar_type == 1;
    }
);

For other helpers (mockThrow, mockReturnThis, etc.) see Mock.php
Spying

$mock_foo = mock('Foo');
$mock->mockReturn('bar', 1);

$code_under_test->doSomething($mock_foo);

// Returns array of calls
$mock_foo->mockGetCalls('bar');

If you are using PHPUnit, you can add FBMock_AssertionHelpers to your base PHPUnit_TestCase to get some spying helpers:

$this->assertCalledOnce($mock_foo, 'bar');
$this->assertCalledOnce($mock_foo, 'bar', $expected_params_as_array); // param assertion is optional
$this->assertCalls($mock_foo, 'bar', $expected_params_for_first_call, $expected_params_for_second_call, ...);

Tips
Use multiset capabilities to improve legibility

mock('Foo')->mockReturn(array(
    'bar' => 1,
    'get' => 'data',
    'run' => true,
))->mockReturnThis('set', 'addID', 'removeID');

Utilize the fluent interface for concise mock setup.

mock('Foo')
    ->mockReturn('bar', 1)
    ->mockThrow('other_method')
    ->mockImplementation('another_method', function () { // })
    ->mockReturnThis('setData');

Use strict mocks when it's critical a method isn't called

If any unmocked method is called, the mock will throw.

$db_conn = strict_mock('DBConnection')->mockReturn('read', $data);

// ...in code under test
$db_conn->write($some_data); // Throws FBMock_MockFrameworkException

Customizing

See CustomConfig-sample.php for instructions on customizing FBMock for your needs.
HHVM-only features

    Mock final classes and classes with final methods
    Mock internal classes

Community

We have a mailing list. If you're using FBMock, send us an email to say hi!
 */