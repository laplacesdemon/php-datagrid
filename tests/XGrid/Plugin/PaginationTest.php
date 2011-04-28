<?php

  /*
   * 
   */

  /**
   * Description of PaginationTest
   *
   * @author suleymanmelikoglu [at] oyunstudyosu.com
   * @group tmp
   */
  class XGrid_Plugin_PaginationTest extends BaseTestCase {
      
      private function _getXGrid() {
          $grid = new XGrid();
          $grid->addDataField("name", "Name", XGrid_DataField::TEXT);
          $grid->addDataField("surname", "SurName", XGrid_DataField::TEXT);
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
          return $grid;
      }
      
      public function testPaginationUsage() {
          $expected = "<table><thead><tr><th>Name</th><th>SurName</th></tr></thead>";
          $expected .= "<tbody>";
          $expected .= "<tr><td>Value 11</td><td>Value 12</td></tr>";
          $expected .= "<tr><td>Value 21</td><td>Value 22</td></tr>";
          $expected .= "</tbody>";
          $expected .= "<tfoot>previous &lt; " . 
                        "<a href='http://localhost/xgrid?p=1'>1</a> |" . 
                        "<a href='http://localhost/xgrid?p=2'>2</a> |" . 
                        "3 &gt; next</tfoot></table>";
          
          $xgrid = $this->_getXGrid();
          
          $currentPage = 3;
          $perPage = 2;
          $range = 6;
          $type = XGrid_Plugin_Pagination::SLIDING;
          
          $paginator = new XGrid_Plugin_DefaultPaginator();
          $paginator->setCurrentPage($currentPage);
          $paginator->setItemCountPerPage($perPage);
          $paginator->setType($type);
          $paginator->setRange($range);
          
          $xgrid->registerPlugin($paginator);
          
          
          $xgrid->dispatch();
          $this->assertEquals($expected, $xgrid->__toString());
          
      }
      
  }

