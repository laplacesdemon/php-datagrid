<?php

  /*
   * 
   */

  /**
   * Description of HelperDefaultTest
   *
   * @author suleymanmelikoglu [at] oyunstudyosu.com
   * @group grid
   */
  class HelperFooterTest extends BaseTestCase {
   
      
      public function testfooterAddColumn() {
          
          $expected = "<tfoot><tr><th>my pagination</th></tr></tfoot>";
          
          $footer = new XGrid_HtmlHelper_TableFooter();
          
          $tr = new XGrid_HtmlHelper_Item("tr");
          $newColumn = new XGrid_HtmlHelper_Item("th");
          $newColumn->setTag("th"); // optional
          $newColumn->setValue("my pagination");
          $tr->append($newColumn);
          $footer->append($tr);
          
          //var_dump($footer);
          
          $this->assertEquals($expected, $footer->render());
      }
      
      
      
  }
