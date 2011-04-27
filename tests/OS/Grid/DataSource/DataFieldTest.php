<?php

  /*
   * Please see oyunstudyosu license file
   */

  /**
   * Description of DataFieldTest
   *
   * @author suleymanmelikoglu [at] oyunstudyosu.com
   * @group grid
   */
  class OS_Grid_DataFieldTest extends BaseTestCase {
      
      public function testCreate() {
          
          $exp = new OS_Grid_DataField_Text();
          $exp->setKey("My Title");
          
          $res = OS_Grid_DataField::create(OS_Grid_DataField::TEXT, "My Title");
          
      }
      
      public function testCreate2() {
          
          $exp = new OS_Grid_DataField_Text();
          $exp->setKey("My Title");
          $exp->setOptions(array("o1" => "v1", "o2" => "v2"));
          $exp->addFilter(new OS_Grid_Filter_Uppercase());
          
          $res = OS_Grid_DataField::create(OS_Grid_DataField::TEXT, "My Title",
                  array("o1" => "v1", "o2" => "v2"), new OS_Grid_Filter_Uppercase());
          
          $this->assertEquals($exp, $res);
          
      }
      
  }
