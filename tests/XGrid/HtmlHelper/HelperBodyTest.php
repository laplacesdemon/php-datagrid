<?php

  /*
   * 
   */

  /**
   * Description of HelperDefaultTest
   *
   * @author suleyman [at] melikoglu.info
   * @group grid
   */
  class HelperBodyTest extends BaseTestCase {
   
      public function testHeaderBasicUsage() {
          
          $expected = "<tbody>";
          $expected .= "<tr><td>suleyman</td><td>solomon@gmail.com</td></tr>";
          $expected .= "<tr><td>suleyman2</td><td>solomon2@gmail.com</td></tr>";
          $expected .= "</tbody>";
          
          // table header has setColumns method 
          $body = new XGrid_HtmlHelper_TableBody();
          $this->assertTrue($body instanceof XGrid_HtmlHelper_Item);
          $this->assertTrue($body instanceof XGrid_HtmlHelper_Renderable);
          
          $data = array(
              array("name" => "suleyman", "email" => "solomon@gmail.com"),
              array("name" => "suleyman2", "email" => "solomon2@gmail.com")
          );
          $ds = new XGrid_DataSource_Array($data);
          
          $body->setData($ds);
          
          $data = array(
              XGrid_DataField::create(XGrid_DataField::TEXT, "name", "Username"),
              XGrid_DataField::create(XGrid_DataField::TEXT, "email", "Email")
          );
          
          $body->setColumns($data);
          
          $this->assertEquals(trim($expected), trim($body->render()));
          
      }
      
  }
