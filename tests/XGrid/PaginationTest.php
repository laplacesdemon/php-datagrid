<?php

  /*
   * 
   */

  /**
   * @todo write the tests for pagination
   *
   * @author suleymanmelikoglu [at] oyunstudyosu.com
   */
  class PaginationTest extends BaseTestCase {
      
      public function testPagination() {
          $expected = "<table><thead><tr><th>Name</th><th>SurName</th></tr></thead>";
          $expected .= "<tbody>";
          $expected .= "<tr><td>Value 11</td><td>Value 12</td></tr>";
          $expected .= "<tr><td>Value 21</td><td>Value 22</td></tr>";
          $expected .= "</tbody>";
          $expected .= "<tfoot>";
          $expected .= "<tr><td colspan='2' ><div class='paginationControl'><a href='http://localhost/test?p=2'>&lt; Previous</a> | " .
                        "<a href='http://localhost/test?p=1'>1</a> | <a href='http://localhost/test?p=2'>2</a> | " .
                        "3 | <span class='disabled'>Next &gt;</span></div></td></tr>";
          $expected .= "</tfoot></table>";
          
          $grid = new XGrid();
          $grid->addField("name", "Name", XGrid_DataField::TEXT);
          $grid->addField("surname", "SurName", XGrid_DataField::TEXT);
          $data = array(
              array("name" => "Value 01", "surname" => "Value 00"),
              array("name" => "Value 02", "surname" => "Value 00"),
              array("name" => "Value 03", "surname" => "Value 00"),
              array("name" => "Value 04", "surname" => "Value 00"),
              array("name" => "Value 11", "surname" => "Value 12"),
              array("name" => "Value 21", "surname" => "Value 22")
          );
          $dataSource = new XGrid_DataSource_Array($data);
          $grid->setDataSource($dataSource);
          
          $currentPage = 3;
          $perPage = 2;
          $range = 6;
          $type = XGrid_Plugin_Pagination::SLIDING;
          $paginator = new XGrid_Plugin_DefaultPaginator();
          $paginator->setCurrentPage($currentPage);
          $paginator->setItemCountPerPage($perPage);
          $paginator->setRange($range);
          $paginator->setType($type);
          $paginator->setBaseUrl("http://localhost/test");
          
          $grid->registerPlugin($paginator);
          
          $grid->dispatch();
          
          $this->assertEquals($expected, $grid->__toString());   
      }
      
  }

