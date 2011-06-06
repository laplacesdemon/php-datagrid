<?php

  /*
   * git@github.com:laplacesdemon/XGrid.git
   */

  /**
   * Description of GridTest
   *
   * @author suleyman [at] melikoglu.info
   * @group grid
   */
  class XGridTest extends BaseTestCase {
      
      public function testInstantiation() {
          $grid = new XGrid();
          $this->assertTrue($grid instanceof XGrid_Plugin_Interface);
      }
      
      public function testAddField() {
          $expected = new XGrid_DataField_Text();
          $expected->setTitle("My Key");
          $expected->setKey("myKeyIndex");
          
          $grid = new XGrid();
          $grid->addField("myKeyIndex", "My Key", XGrid_DataField::TEXT);
          
          $this->assertEquals($expected, $grid->getDataField("myKeyIndex")); 
      }
      
      public function testAddDataField2() {
          $expected = new XGrid_DataField_Text();
          $expected->setKey("myKeyIndex");
          $expected->setTitle("My Key");
          
          $grid = new XGrid();
          $grid->addField("myKeyIndex", "My Key", new XGrid_DataField_Text() );
          
          $this->assertEquals($expected, $grid->getDataField("myKeyIndex")); 
      }
      
      public function testDispatch() {
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
          $grid->addField(1, "Name", XGrid_DataField::TEXT);
          $grid->addField(2, "SurName", XGrid_DataField::TEXT);
          $data = array(
              array("Value 11", "Value 12"),
              array("Value 21", "Value 22")
          );
          $dataSource = new XGrid_DataSource_Array($data);
          $grid->setDataSource($dataSource);
          $grid->dispatch();
          
          $this->assertEquals($expected, $grid->__toString());
      }*/
      
      public function testPaginationWithOptions() {
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
          
          $grid = new XGrid(array(
              'pagination' => array(
                  'currentPage' => 3,
                  'perPage' => 2,
                  'baseUrl' => 'http://localhost/test'
              )
          ));
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
          $grid->addField("name", "Name", XGrid_DataField::TEXT);
          $grid->addField("surname", "SurName", XGrid_DataField::TEXT);
          $data = array(
              array("id" => "my id 1", "name" => "Value 11", "surname" => "Value 12"),
              array("id" => "my id 2", "total" => "nr", "name" => "Value 21", "surname" => "Value 22")
          );
          $dataSource = new XGrid_DataSource_Array($data);
          $grid->setDataSource($dataSource);
          $grid->dispatch();
          
          $this->assertEquals($expected, $grid->__toString());
      }
      
      public function testDispatchCustomAttributes() {
          $expected = "<table class='myTableClass'><thead><tr><th>Name</th><th>SurName</th><th>Raw URL</th><th>Tidy URL</th></tr></thead>";
          $expected .= "<tbody>";
          $expected .= "<tr><td>Value 11</td><td>Value 12</td><td><a href=\"http://example.com\">http://example.com</a></td><td><a href=\"http://example.com\" title=\"Value 11\">Value 11</a></td></tr>";
          $expected .= "<tr><td>Value 21</td><td>Value 22</td><td><a href=\"http://example2.com\">http://example2.com</a></td><td><a href=\"http://example2.com\" title=\"Value 21\">Value 21</a></td></tr>";
          $expected .= "</tbody>";
          $expected .= "<tfoot></tfoot></table>";
          
          $grid = new XGrid();
          $grid->addField("name", "Name", XGrid_DataField::TEXT);
          $grid->addField("surname", "SurName", XGrid_DataField::TEXT);
          $grid->addField("url", "Raw URL", XGrid_DataField::URL);
          $tidyURLFields = new XGrid_DataField_URL();
          $tidyURLFields->registerOnRender(function(XGrid_DataField_Event $event) {
              $data = $event->getData();
              $event->getDataField()->setAttributes(array(
                  'displayText' => $data->name,
                  'title' => $data->name
              ));
              return $data->url;
          });
          $grid->addField('tidyURLs', 'Tidy URL', $tidyURLFields);
          $data = array(
              array("name" => "Value 11", "surname" => "Value 12", "url" => "http://example.com"),
              array("name" => "Value 21", "surname" => "Value 22", "url" => "http://example2.com")
          );
          $dataSource = new XGrid_DataSource_Array($data);
          $grid->setDataSource($dataSource);
          $grid->addAttribute('class', 'myTableClass');
          
          $grid->dispatch();
          
          $this->assertEquals($expected, $grid->__toString());
      }
      
      public function testAutoAdditionOfDataFields() {
          $expected = "<table><thead><tr><th>name</th><th>surname</th></tr></thead>";
          $expected .= "<tbody>";
          $expected .= "<tr><td>Value 11</td><td>Value 12</td></tr>";
          $expected .= "<tr><td>Value 21</td><td>Value 22</td></tr>";
          $expected .= "</tbody>";
          $expected .= "<tfoot></tfoot></table>";
          
          $grid = new XGrid();
          $data = array(
              array("name" => "Value 11", "surname" => "Value 12"),
              array("name" => "Value 21", "surname" => "Value 22")
          );
          $dataSource = new XGrid_DataSource_Array($data);
          $grid->setDataSource($dataSource);
          $grid->dispatch();
          
          $this->assertEquals($expected, $grid->__toString());
      }
      
  }

