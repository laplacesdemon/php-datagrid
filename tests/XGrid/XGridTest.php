<?php

  /*
   * git@github.com:laplacesdemon/XGrid.git
   */

  /**
   * Description of GridTest
   *
   * @author suleymanmelikoglu [at] oyunstudyosu.com
   * @group grid
   */
  class XGridTest extends BaseTestCase {
      
      public function testInstantiation() {
          $grid = new XGrid();
          $this->assertTrue($grid instanceof XGrid_Plugin_Interface);
      }
      
      public function testAddDataField() {
          $expected = new XGrid_DataField_Text();
          $expected->setTitle("My Key");
          $expected->setKey("myKeyIndex");
          
          $grid = new XGrid();
          $grid->addDataField("myKeyIndex", "My Key", XGrid_DataField::TEXT);
          
          $this->assertEquals($expected, $grid->getDataField("myKeyIndex")); 
      }
      
      public function testAddDataField2() {
          $expected = new XGrid_DataField_Text();
          $expected->setKey("myKeyIndex");
          $expected->setTitle("My Key");
          
          $grid = new XGrid();
          $grid->addDataField("myKeyIndex", "My Key", new XGrid_DataField_Text("My Key") );
          
          $this->assertEquals($expected, $grid->getDataField("myKeyIndex")); 
      }
      
      public function testPrepareHead() {
          $expected = "<table><thead><tr><th>Name</th><th>SurName</th></tr></thead>";
          
          $grid = new XGrid();
          $grid->addDataField(1, "Name", XGrid_DataField::TEXT);
          $grid->addDataField(2, "SurName", XGrid_DataField::TEXT);
          
          
          $method = self::getMethod("XGrid", "_prepareHead");
          
          $this->assertEquals($expected, $method->invokeArgs($grid, array()));
          
      }
      
      public function testPrepareBody() {
          $expected = "<tbody>";
          $expected .= "<tr><td>Value 11</td><td>Value 12</td></tr>";
          $expected .= "<tr><td>Value 21</td><td>Value 22</td></tr>";
          $expected .= "</tbody>";
          
          
          $grid = new XGrid();
          $grid->addDataField("name", "Name", XGrid_DataField::TEXT);
          $grid->addDataField("surname", "SurName", XGrid_DataField::TEXT);
          
          $data = array(
              array("name" => "Value 11", "surname" => "Value 12"),
              array("name" => "Value 21", "surname" => "Value 22")
          );
          $dataSource = new XGrid_DataSource_Array($data);
          $grid->setDataSource($dataSource);
          
          
          $method = self::getMethod("XGrid", "_prepareBody");
          
          $this->assertEquals($expected, $method->invokeArgs($grid, array()));
      }
      
      public function testPrepareFooter() {
          $expected = "<tfoot></tfoot></table>";
          
          $grid = new XGrid();
          $grid->addDataField(1, "Name", XGrid_DataField::TEXT);
          $grid->addDataField(2, "SurName", XGrid_DataField::TEXT);
          
          
          $method = self::getMethod("XGrid", "_prepareFooter");
          
          $this->assertEquals($expected, $method->invokeArgs($grid, array()));
      }
      
      public function testDispatch() {
          $expected = "<table><thead><tr><th>Name</th><th>SurName</th></tr></thead>";
          $expected .= "<tbody>";
          $expected .= "<tr><td>Value 11</td><td>Value 12</td></tr>";
          $expected .= "<tr><td>Value 21</td><td>Value 22</td></tr>";
          $expected .= "</tbody>";
          $expected .= "<tfoot></tfoot></table>";
          
          $grid = new XGrid();
          $grid->addDataField("name", "Name", XGrid_DataField::TEXT);
          $grid->addDataField("surname", "SurName", XGrid_DataField::TEXT);
          $data = array(
              array("name" => "Value 11", "surname" => "Value 12"),
              array("name" => "Value 21", "surname" => "Value 22")
          );
          $dataSource = new XGrid_DataSource_Array($data);
          $grid->setDataSource($dataSource);
          $grid->dispatch();
          
          $this->assertEquals($expected, $grid->__toString());
      }
      
      /**
       * non-associated arrays are not supported at the moment 
       *
      public function testDispatchNonAssociate() {
          $expected = "<table><thead><tr><th>Name</th><th>SurName</th></tr></thead>";
          $expected .= "<tbody>";
          $expected .= "<tr><td>Value 11</td><td>Value 12</td></tr>";
          $expected .= "<tr><td>Value 21</td><td>Value 22</td></tr>";
          $expected .= "</tbody>";
          $expected .= "<tfoot></tfoot></table>";
          
          $grid = new XGrid();
          $grid->addDataField(1, "Name", XGrid_DataField::TEXT);
          $grid->addDataField(2, "SurName", XGrid_DataField::TEXT);
          $data = array(
              array("Value 11", "Value 12"),
              array("Value 21", "Value 22")
          );
          $dataSource = new XGrid_DataSource_Array($data);
          $grid->setDataSource($dataSource);
          $grid->dispatch();
          
          $this->assertEquals($expected, $grid->__toString());
      }*/
      
      public function testPagination() {
          $expected = "<table><thead><tr><th>Name</th><th>SurName</th></tr></thead>";
          $expected .= "<tbody>";
          $expected .= "<tr><td>Value 11</td><td>Value 12</td></tr>";
          $expected .= "<tr><td>Value 21</td><td>Value 22</td></tr>";
          $expected .= "</tbody>";
          $expected .= "<tfoot></tfoot></table>";
          
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
          
          $currentPage = 3;
          $perPage = 2;
          $range = 6;
          $type = XGrid_Pagination::SLIDING;
          $grid->setPagination($currentPage, $perPage, $type, $range);
          
          $grid->dispatch();
          
          $this->assertEquals($expected, $grid->__toString());   
      }
      
      public function testDispatchCustomFields() {
          $expected = "<table><thead><tr><th>Name</th><th>SurName</th></tr></thead>";
          $expected .= "<tbody>";
          $expected .= "<tr><td>Value 11</td><td>Value 12</td></tr>";
          $expected .= "<tr><td>Value 21</td><td>Value 22</td></tr>";
          $expected .= "</tbody>";
          $expected .= "<tfoot></tfoot></table>";
          
          $grid = new XGrid();
          $grid->addDataField("name", "Name", XGrid_DataField::TEXT);
          $grid->addDataField("surname", "SurName", XGrid_DataField::TEXT);
          $data = array(
              array("id" => "my id 1", "name" => "Value 11", "surname" => "Value 12"),
              array("id" => "my id 2", "total" => "nr", "name" => "Value 21", "surname" => "Value 22")
          );
          $dataSource = new XGrid_DataSource_Array($data);
          $grid->setDataSource($dataSource);
          $grid->dispatch();
          
          $this->assertEquals($expected, $grid->__toString());
      }
      
  }

