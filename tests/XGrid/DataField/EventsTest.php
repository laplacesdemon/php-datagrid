<?php

  /*
   * 
   */

  /**
   * Description of EventsTest
   *
   * @author suleymanmelikoglu [at] oyunstudyosu.com
   * @group tmp
   */
  class XGrid_DataField_EventsTest extends BaseTestCase {
   
      public function testUsageWithCustomDataStructure() {
          
          $expected = "<table><thead><tr><th>Name</th><th>Custom Field</th></tr></thead>";
          $expected .= "<tbody>";
          $expected .= "<tr><td>Value 11</td><td>item 11, item 12</td></tr>";
          $expected .= "<tr><td>Value 21</td><td>item 21, item 22</td></tr>";
          $expected .= "</tbody>";
          $expected .= "<tfoot></tfoot></table>";
          
          $grid = new XGrid();
          
          $statusDataField = new XGrid_DataField_Text();
          $statusDataField
                          // no need to set the key if you use a custom handler
                          //->addKey("resource") 
                          ->setDefaultText("Waiting for reply")
                          ->registerOnRender(function(XGrid_DataField_Event $event) {
                              $return = array();
                              $data = $event->getData();
                              foreach ($data->custom as $value) {
                                  array_push($return, $value->email);
                              }
                              return implode(', ', $return);
                          })
          ; 
          
          $grid->addField('name', 'Name', XGrid_DataField::TEXT);
          $grid->addField('custom', 'Custom Field', $statusDataField);                
                          
          $custom1 = array();
          $customValue1 = new stdClass();
          $customValue1->email = 'item 11'; 
          $custom1[] = $customValue1;
          
          $customValue1 = new stdClass();
          $customValue1->email = 'item 12'; 
          $custom1[] = $customValue1;
          
          $custom2 = array();
          $customValue1 = new stdClass();
          $customValue1->email = 'item 21'; 
          $custom2[] = $customValue1;
          
          $customValue1 = new stdClass();
          $customValue1->email = 'item 22'; 
          $custom2[] = $customValue1;
          
          $data = array(
              array("name" => "Value 11", "custom" => $custom1),
              array("name" => "Value 21", "custom" => $custom2)
          );
          
          $dataSource = new XGrid_DataSource_Array($data);
          $grid->setDataSource($dataSource);
          
          $grid->dispatch();
                          
          $this->assertEquals($expected, $grid->__toString());
      }
      
  }
