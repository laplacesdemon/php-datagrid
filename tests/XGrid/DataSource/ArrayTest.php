<?php

  /*
   * git@github.com:laplacesdemon/XGrid.git
   */

  /**
   * Description of ArrayTest
   *
   * @author suleyman [at] melikoglu.info
   * @group grid
   */
  class XGrid_DataSource_ArrayTest extends BaseTestCase {

      public function testObjects() {
          
          $data = array(
              array("name" => "Value 11", "surname" => "Value 12"),
              array("name" => "Value 21", "surname" =>  "Value 22")
          );
          $cls = new XGrid_DataSource_Array($data);
                    
          $this->assertTrue($cls instanceof IteratorAggregate);
          $this->assertEquals(2, sizeof($cls));
          
          $iterator = $cls->getIterator();
          
          $this->assertEquals("Value 11", $iterator->current()->name);
          $this->assertEquals("Value 12", $iterator->current()->surname);
          
          $iterator->next();
          
          $this->assertEquals("Value 21", $iterator->current()->name);
          $this->assertEquals("Value 22", $iterator->current()->surname);
          
      }
      
  }
