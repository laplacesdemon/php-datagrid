<?php

  /*
   * Please see oyunstudyosu license file
   */

  /**
   * Description of ArrayTest
   *
   * @author suleymanmelikoglu [at] oyunstudyosu.com
   * @group grid
   */
  class XGrid_DataSource_ArrayTest extends BaseTestCase {

      public function testObjects() {
          
          $data = array(
              array("name" => "Value 11", "surname" => "Value 12"),
              array("name" => "Value 21", "surname" =>  "Value 22")
          );
          $cls = new XGrid_DataSource_Array($data);
          
          $this->assertTrue($cls instanceof Iterator);
          $this->assertEquals(2, sizeof($cls));
          
          $this->assertEquals("Value 11", $cls->current()->name);
          $this->assertEquals("Value 12", $cls->current()->surname);
          
          $cls->next();
          
          $this->assertEquals("Value 21", $cls->current()->name);
          $this->assertEquals("Value 22", $cls->current()->surname);
          
      }
      
  }
