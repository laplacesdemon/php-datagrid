<?php

  /*
   * 
   */

  /**
   * Description of Appender
   *
   * @author suleymanmelikoglu [at] oyunstudyosu.com
   * @group grid
   */
  class XGrid_Filter_FirstWordTest extends BaseTestCase {

      public function testAppenderFilter() {
          $filter = new XGrid_Filter_FirstWord();
          
          $class = new XGrid_DataField_Text();
          $class->setKey("My Data Key");
          $class->addFilter($filter);
          
          $val = "solomon the super villain";
          $res = $class->filter($val);
          $this->assertEquals("solomon", $res);
      }
      
  
  }

