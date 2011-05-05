<?php

  /*
   * git@github.com:laplacesdemon/XGrid.git
   */

  /**
   * Description of TextTest
   *
   * @author suleymanmelikoglu [at] oyunstudyosu.com
   * @group grid
   */
  class XGrid_DataField_TextFunctionalTest extends BaseTestCase {
   
      public function testDispatchCustomFields() {
          $expected = "<table><thead><tr><th>Name</th><th>SurName</th></tr></thead>";
          $expected .= "<tbody>";
          $expected .= "<tr><td>Value 11</td><td>Value 12</td></tr>";
          $expected .= "<tr><td>Value 21</td><td>Value 22</td></tr>";
          $expected .= "</tbody>";
          $expected .= "<tfoot></tfoot></table>";
          
          $grid = new XGrid();
          $grid->addDataField("name", "Name", XGrid_DataField::TEXT);
          
          $df = new XGrid_DataField_Text();
          $df->addKey("email");
          $df->addKey("primary");
          
          $grid->addDataField("surname", "SurName", $df);
          $data = array(
              array("name" => "Value 11", "email" => array("primary" => "Value 12")),
              array("name" => "Value 21", "email" => array("primary" => "Value 22"))
          );
          $dataSource = new XGrid_DataSource_Array($data);
          $grid->setDataSource($dataSource);
          $grid->dispatch();
          
          $this->assertEquals($expected, $grid->__toString());
      }
      
  }
