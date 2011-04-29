<?php

  /*
   * 
   */

  /**
   * Description of ItemTest
   *
   * @author suleymanmelikoglu [at] oyunstudyosu.com
   * @group grid
   */
  class XGrid_HtmlHelper_ItemTest extends BaseTestCase {
   
      public function testUsage() {
          
          $expected = "<p>test</p>";
          
          $i = new XGrid_HtmlHelper_Item("p");
          $i->setValue("test");
          
          $this->assertEquals($expected, $i->render());
      }
      
      public function testUsageAlternativeSyntax() {
          
          $expected = "<p>test</p>";
          
          $i = new XGrid_HtmlHelper_Item();
          $i->setTag("p");
          $i->setValue("test");
          
          $this->assertEquals($expected, $i->render());
      }
      
      public function testClasses() {
          
          $expected = "<p class='myclass'>test</p>";
          
          $i = new XGrid_HtmlHelper_Item("p");
          $i->setValue("test");
          $i->addAttribute("class", "myclass");
          
          $this->assertEquals($expected, $i->render());
      }
      
      public function testNestedItems() {
          $expected = "<p><div>a</div>test<div>b</div></p>";
          
          $i = new XGrid_HtmlHelper_Item("p");
          $i->setValue("test");
          
          $i2 = new XGrid_HtmlHelper_Item("div");
          $i2->setValue("a");
          
          $i3 = new XGrid_HtmlHelper_Item("div");
          $i3->setValue("b");
          
          $i->prepend($i2);
          $i->append($i3);
          
          $this->assertEquals($expected, $i->render());
          
      }
  
  }
