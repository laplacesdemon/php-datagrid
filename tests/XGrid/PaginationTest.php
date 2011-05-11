<?php

  /*
   * 
   */

  /**
   * Description of PaginationTest
   *
   * @author suleymanmelikoglu [at] oyunstudyosu.com
   */
  class PaginationTest extends BaseTestCase {

      public function testPaginationView() {
          $expected = "<table><thead><tr><th>Name</th><th>SurName</th></tr></thead>";
          $expected .= "<tbody>";
          $expected .= "<tr><td>Value 11</td><td>Value 12</td></tr>";
          $expected .= "<tr><td>Value 21</td><td>Value 22</td></tr>";
          $expected .= "</tbody>";
          $expected .= "<tfoot></tfoot></table>";
          
          $grid = new XGrid();
          $grid->addField("name", "Name", XGrid_DataField::TEXT);
          $grid->addField("surname", "SurName", XGrid_DataField::TEXT);
          $data = array(
              array("id" => "my id 1", "name" => "Value 11", "surname" => "Value 12"),
              array("id" => "my id 2", "total" => "nr", "name" => "Value 21", "surname" => "Value 22")
          );
          $dataSource = new XGrid_DataSource_Array($data);
          $grid->setDataSource($dataSource);
          $grid->setPagination(2, 2, XGrid_Pagination::ELASTIC, 6);
          
          $grid->dispatch();
          
          $this->assertEquals($expected, $grid->__toString());
      }
      
  }

