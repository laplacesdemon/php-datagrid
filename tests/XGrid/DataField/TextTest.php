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
  class XGrid_DataField_TextTest extends BaseTestCase {
   
      public function testUsage() {
          // data field class represents the value of a field in a row.
          $class = new XGrid_DataField_Text();
          $class->setKey("My Data Key");
          
          $expected = new XGrid_DataField_LinkedList();
          $expected->setKey("My Data Key");
          $this->assertEquals($expected, $class->getKey());
      }
      
      public function testConstructor() {
          // data field class represents the value of a field in a row.
          $class = new XGrid_DataField_Text("My Data Key");
          
          $expected = new XGrid_DataField_LinkedList();
          $expected->setKey("My Data Key");
          $this->assertEquals($expected, $class->getKey());
      }
      
      public function testShouldReturnCorrectValue() {
          // Fetching the email value from the User class
          $data = new stdClass();
          $data->User = "suleyman";
          
          $instance = new XGrid_DataField_Text();
          $instance->addKey("User");
          
          $this->assertEquals("suleyman", $instance->getValue($data));
      }


      public function testShouldHaveFilters() {
          $filter = new XGrid_Filter_Uppercase();
          
          $class = new XGrid_DataField_Text();
          $class->setKey("My Data Key");
          $class->addFilter($filter);
          
          $val = "my val";
          $res = $class->filter($val);
          $this->assertEquals("MY VAL", $res);
          
      }
      
      public function testShouldHaveRecursiveKeys() {
          // Fetching the email value from the User class
          $data = new stdClass();
          $data->User = new stdClass();
          $data->User->email = "suleyman@melikoglu.info";
          
          $instance = new XGrid_DataField_Text();
          $instance->addKey("User");
          $instance->addKey("email");
          
          $this->assertEquals("suleyman@melikoglu.info", $instance->getValue($data));
          
      }
      
      public function testIntegrationShouldGetValueFromDifferentTextField() {
          $expected = "<table><thead><tr><th>Name</th><th>Fullname</th></tr></thead>";
          $expected .= "<tbody>";
          $expected .= "<tr><td>suleyman</td><td>suleyman the melikoglu</td></tr>";
          $expected .= "<tr><td>can</td><td>can the arbaz</td></tr>";
          $expected .= "</tbody>";
          $expected .= "<tfoot></tfoot></table>";
          
          $grid = new XGrid();
          $grid->addDataField("name", "Name", XGrid_DataField::TEXT);
          
          $class = new XGrid_DataField_Text();
          $class->setKey("Fullname");
          $filter = new XGrid_Filter_Concatenator('', ' the {%surname}');
          $class->addFilter($filter);
          
          $grid->addDataField("name", "Fullname", $class);
          $data = array(
              array("name" => "suleyman", "surname" => "melikoglu"),
              array("name" => "can", "surname" => "arbaz")
          );
          $dataSource = new XGrid_DataSource_Array($data);
          $grid->setDataSource($dataSource);
          $grid->dispatch();
          
          $this->assertEquals($expected, $grid->__toString());
      }
      
      
      
      
  }
