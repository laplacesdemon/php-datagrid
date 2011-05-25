<?php

  /*
   * 
   */

  /**
   * Description of HtmlHelperTest
   *
   * @author suleyman [at] melikoglu.info
   * @group grid
   */
  class XGrid_HtmlHelper_DefaultTest extends BaseTestCase {
   
      public function testUsage() {
       
          $expected = "<table>";
          $expected .= "<thead><tr><th>Username</th><th>Email</th></tr></thead>";
          $expected .= "<tbody>";
          $expected .= "<tr><td>suleyman</td><td>solomon@gmail.com</td></tr>";
          $expected .= "<tr><td>suleyman2</td><td>solomon2@gmail.com</td></tr>";
          $expected .= "</tbody>";
          $expected .= "<tfoot></tfoot>";
          $expected .= "</table>";
          
          $data = array(
              array("name" => "suleyman", "email" => "solomon@gmail.com"),
              array("name" => "suleyman2", "email" => "solomon2@gmail.com")
          );
          $ds = new XGrid_DataSource_Array($data);
          
          $datafields = array(
              XGrid_DataField::create(XGrid_DataField::TEXT, "name", "Username"),
              XGrid_DataField::create(XGrid_DataField::TEXT, "email", "Email")
          );
          
          $instance = new XGrid_HtmlHelper_Default();
          $instance->setData($ds);
          $instance->setColumns($datafields);
          
          // table header has setColumns method 
          $this->assertTrue($instance instanceof XGrid_HtmlHelper_Item);
          $this->assertTrue($instance instanceof XGrid_HtmlHelper_Renderable);
          
          $instance->init();
          
          $this->assertTrue($instance->getHeader() instanceof XGrid_HtmlHelper_Item);
          $this->assertTrue($instance->getBody() instanceof XGrid_HtmlHelper_Item);
          $this->assertTrue($instance->getFooter() instanceof XGrid_HtmlHelper_Item);
          
          $this->assertEquals($expected, $instance->render());
      }
      
  }
