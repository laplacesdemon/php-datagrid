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
  class HelperHeaderTest extends BaseTestCase {
   
      public function testHeaderBasicUsage() {
          
          $expected = "<thead><tr><th>Username</th><th>Email</th></tr></thead>";
          
          // table header has setColumns method 
          $header = new XGrid_HtmlHelper_TableHeader();
          $this->assertTrue($header instanceof XGrid_HtmlHelper_Item);
          $this->assertTrue($header instanceof XGrid_HtmlHelper_Renderable);
          
          $data = array(
              XGrid_DataField::create(XGrid_DataField::TEXT, "name", "Username"),
              XGrid_DataField::create(XGrid_DataField::TEXT, "email", "Email")
          );
          
          $header->setColumns($data);
          
          $this->assertEquals($expected, $header->render());
      }
      
      public function testHeaderAddColumn() {
          
          $expected = "<thead><tr><th>Username</th><th>Email</th><th>AddedRow</th></tr></thead>";
          
          $header = new XGrid_HtmlHelper_TableHeader();
          
          $data = array(
              XGrid_DataField::create(XGrid_DataField::TEXT, "name", "Username"),
              XGrid_DataField::create(XGrid_DataField::TEXT, "email", "Email")
          );
          
          $header->setColumns($data);
          
          $newColumn = new XGrid_HtmlHelper_Item("th");
          $newColumn->setTag("th"); // optional
          $newColumn->setValue("AddedRow");
          $header->append($newColumn,0);
          
          //var_dump($header);
          
          $this->assertEquals($expected, $header->render());
      }
      
      public function testHeaderAddRow() {
          
          $expected = "<thead><tr><th>Username</th><th>Email</th></tr>" . 
                        "<tr><th>newrow1</th><th>newrow2</th></tr></thead>";
          
          $header = new XGrid_HtmlHelper_TableHeader();
          
          $data = array(
              XGrid_DataField::create(XGrid_DataField::TEXT, "name", "Username"),
              XGrid_DataField::create(XGrid_DataField::TEXT, "email", "Email")
          );
          
          $header->setColumns($data);
          
          $newColumn1 = new XGrid_HtmlHelper_Item("th");
          $newColumn1->setTag("th"); // optional
          $newColumn1->setValue("newrow1");
          
          $newColumn2 = new XGrid_HtmlHelper_Item("th");
          $newColumn2->setTag("th"); // optional
          $newColumn2->setValue("newrow2");
          
          $newRow = new XGrid_HtmlHelper_Item("tr");
          $newRow->append($newColumn1);
          $newRow->append($newColumn2);
          
          $header->append($newRow);
          
          $this->assertEquals($expected, $header->render());
      }
      
      public function testHeaderAddColumn2() {
          
          $expected = "<thead><tr><th>AddedRow</th></tr></thead>";
          
          $header = new XGrid_HtmlHelper_TableHeader();
          
          $tr = new XGrid_HtmlHelper_Item("tr");
          $newColumn = new XGrid_HtmlHelper_Item("th");
          $newColumn->setTag("th"); // optional
          $newColumn->setValue("AddedRow");
          $tr->append($newColumn);
          $header->append($tr);
          
          //var_dump($header);
          
          $this->assertEquals($expected, $header->render());
      }
      
  }
