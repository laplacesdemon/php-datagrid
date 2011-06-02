<?php

  /*
   * 
   */

  /**
   * Description of DateTest
   *
   * @author suleyman [at] melikoglu.info
   * @group tmp
   */
  class DateTest extends BaseTestCase {
   
      public function testBasicUsage() {
          $data = new stdClass();
          $data->timestamp = strtotime("25 April 2011");
          
          $instance = new XGrid_DataField_DefaultDate();
          $instance->addKey("timestamp");
          $instance->setFormat('d.m.Y'); // if does not set, falls back to default format
          
          $this->assertEquals("25.04.2011", $instance->getValue($data));
      }
      
      public function testBasicUsageFailScenerio() {
          $data = new stdClass();
          $data->theDate = strtotime("illegal date");
          
          $instance = new XGrid_DataField_DefaultDate();
          $instance->addKey("theDate");
          $instance->setFormat('d.m.Y'); // if does not set, falls back to default format
          
          $this->assertEquals("01.01.1970", $instance->getValue($data));
      }
      
  }
