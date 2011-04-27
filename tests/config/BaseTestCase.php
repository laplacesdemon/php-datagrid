<?php

  /** @see PHPUnit_Framework_TestCase */
  require_once 'PHPUnit/Framework/TestCase.php';

  /** @see PHPUnit_Runner_Version */
  require_once 'PHPUnit/Runner/Version.php';

  abstract class BaseTestCase extends PHPUnit_Framework_TestCase {

      /**
       * use this method to test private and protected methods
       * 
       * @example
       * get the method first
       * $foo = self::getMethod("MyClass", 'myPrivateMethod');
       * $obj = new MyClass();
       * run the method
       * $res = $foo->invokeArgs($obj, array());
       * 
       * @param type $classname
       * @param type $methodname
       * @return type 
       */
      protected static function getMethod($classname, $methodname) {
          $class = new ReflectionClass($classname);
          $method = $class->getMethod($methodname);
          $method->setAccessible(true);
          return $method;
      }

  }

  