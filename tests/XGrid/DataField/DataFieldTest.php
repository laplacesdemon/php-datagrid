<?php

  /*
   * git@github.com:laplacesdemon/XGrid.git
   */

  /**
   * Description of DataFieldTest
   *
   * @author suleyman [at] melikoglu.info
   * @group grid
   */
  class XGrid_DataFieldTest extends BaseTestCase {
      
      public function testCreate() {
          
          $exp = new XGrid_DataField_Text();
          $exp->setKey("My Title");
          
          $res = XGrid_DataField::create(XGrid_DataField::TEXT, "title", "My Title");
          
      }
      
      public function testCreate2() {
          
          $exp = new XGrid_DataField_Text();
          $exp->setKey("title");
          $exp->setTitle("My Title");
          $exp->setOptions(array("o1" => "v1", "o2" => "v2"));
          $exp->addFilter(new XGrid_Filter_Uppercase());
          
          $res = XGrid_DataField::create(XGrid_DataField::TEXT, "title", "My Title",
                  array("o1" => "v1", "o2" => "v2"), new XGrid_Filter_Uppercase());
          
          $this->assertEquals($exp, $res);
          
      }
      
  }
