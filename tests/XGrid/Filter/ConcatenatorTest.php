<?php

  /*
   * 
   */

  /**
   * Description of Appender
   *
   * @author suleyman [at] melikoglu.info
   * @group grid
   */
  class XGrid_Filter_ConcatenatorTest extends BaseTestCase {

      public function testAppenderFilter() {
          $filter = new XGrid_Filter_Concatenator('', ' has read this.');
          
          $class = new XGrid_DataField_Text();
          $class->setKey("My Data Key");
          $class->addFilter($filter);
          
          $val = "solomon";
          $res = $class->filter($val);
          $this->assertEquals("solomon has read this.", $res);
      }
      
      public function testPrependerFilter() {
          $filter = new XGrid_Filter_Concatenator('The idiot ', '');
          
          $class = new XGrid_DataField_Text();
          $class->setKey("My Data Key");
          $class->addFilter($filter);
          
          $val = "solomon";
          $res = $class->filter($val);
          $this->assertEquals("The idiot solomon", $res);
      }
      
      public function testConcatenatorFilter() {
          $filter = new XGrid_Filter_Concatenator('The idiot ', ' has read this.');
          
          $class = new XGrid_DataField_Text();
          $class->setKey("My Data Key");
          $class->addFilter($filter);
          
          $val = "solomon";
          $res = $class->filter($val);
          $this->assertEquals("The idiot solomon has read this.", $res);
      }
  
  }

