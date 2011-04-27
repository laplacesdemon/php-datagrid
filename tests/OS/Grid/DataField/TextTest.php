<?php

  /*
   * Please see oyunstudyosu license file
   */

  /**
   * Description of TextTest
   *
   * @author suleymanmelikoglu [at] oyunstudyosu.com
   * @group grid
   */
  class OS_Grid_DataField_TextTest extends BaseTestCase {
   
      public function testUsage() {
          // data field class represents the value of a field in a row.
          $class = new OS_Grid_DataField_Text();
          $class->setKey("My Data Key");
          
          $this->assertEquals("My Data Key", $class->getKey());
      }
      
      public function testConstructor() {
          // data field class represents the value of a field in a row.
          $class = new OS_Grid_DataField_Text("My Data Key");
          $this->assertEquals("My Data Key", $class->getKey());
      }
      
      public function testShouldHaveFilters() {
          $filter = new OS_Grid_Filter_Uppercase();
          
          $class = new OS_Grid_DataField_Text();
          $class->setKey("My Data Key");
          $class->addFilter($filter);
          
          $val = "my val";
          $res = $class->filter($val);
          $this->assertEquals("MY VAL", $res);
          
      }
      
      
      
  }
