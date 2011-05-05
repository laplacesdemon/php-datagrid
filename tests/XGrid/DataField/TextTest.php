<?php

  /*
   * git@github.com:laplacesdemon/XGrid.git
   */

  /**
   * Description of TextTest
   *
   * @author suleymanmelikoglu [at] oyunstudyosu.com
   * @group grid
   */
  class XGrid_DataField_TextTest extends BaseTestCase {
   
      public function testUsage() {
          // data field class represents the value of a field in a row.
          $class = new XGrid_DataField_Text();
          $class->setKey("My Data Key");
          
          $expected = new XGrid_DataField_LinkedList();
          $expected->setKey("My Data Key");
          $this->assertEquals($expected, $class->getKey());
      }
      
      public function testConstructor() {
          // data field class represents the value of a field in a row.
          $class = new XGrid_DataField_Text("My Data Key");
          
          $expected = new XGrid_DataField_LinkedList();
          $expected->setKey("My Data Key");
          $this->assertEquals($expected, $class->getKey());
      }
      
      public function testShouldReturnCorrectValue() {
          // Fetching the email value from the User class
          $data = new stdClass();
          $data->User = "suleyman";
          
          $instance = new XGrid_DataField_Text();
          $instance->addKey("User");
          
          $this->assertEquals("suleyman", $instance->getValue($data));
      }


      public function testShouldHaveFilters() {
          $filter = new XGrid_Filter_Uppercase();
          
          $class = new XGrid_DataField_Text();
          $class->setKey("My Data Key");
          $class->addFilter($filter);
          
          $val = "my val";
          $res = $class->filter($val);
          $this->assertEquals("MY VAL", $res);
          
      }
      
      public function testShouldHaveRecursiveKeys() {
          // Fetching the email value from the User class
          $data = new stdClass();
          $data->User = new stdClass();
          $data->User->email = "suleyman@melikoglu.info";
          
          $instance = new XGrid_DataField_Text();
          $instance->addKey("User");
          $instance->addKey("email");
          
          
          
          $this->assertEquals("suleyman@melikoglu.info", $instance->getValue($data));
          
      }
      
      
      
      
  }
