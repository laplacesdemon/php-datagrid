<?php

  /*
   * git@github.com:laplacesdemon/XGrid.git
   */

  /**
   * Description of ObjectTest
   *
   * @author suleyman [at] melikoglu.info
   * @group grid
   */
  class XGrid_DataSource_ObjectTest extends BaseTestCase {
      
      public function testObjects() {
          
          $obj1 = new stdClass();
          $obj1->name = "Value 11";
          $obj1->surname = "Value 12";
          
          $obj2 = new stdClass();
          $obj2->name = "Value 21";
          $obj2->surname = "Value 22";
          
          $data = array(
              $obj1, $obj2
          );
          $cls = new XGrid_DataSource_Object($data);
                    
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
