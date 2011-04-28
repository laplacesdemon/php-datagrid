<?php

  /*
   * 
   */

  /**
   * Description of ArrayDecoratorTest
   *
   * @author suleymanmelikoglu [at] oyunstudyosu.com
   * @group grid
   */
  class ArrayDecoratorTest extends BaseTestCase {

      public function testUsage() {
          
          $data = array(
              array("va1" => "a1","va2" => "a2","va3" => "a3"),
              array("va1" => "b1","va2" => "b2","va3" => "b3"),
              array("va1" => "c1","va2" => "c2","va3" => "c3"),
              array("va1" => "e1","va2" => "e2","va3" => "e3"),
              array("va1" => "d1","va2" => "d2","va3" => "d3")
          );
          $datasource = new XGrid_DataSource_Array($data);
          
          $paginator = new XGrid_Plugin_Pagination_Array($datasource);
          $paginator->setCurrentPage(2); // the page offset, we're at 2nd page
          $paginator->setItemCountPerPage(2); // there will be 2 items on per page
          
          $this->assertTrue($paginator instanceof XGrid_DataSource_Interface);
          $this->assertTrue($paginator instanceof XGrid_Plugin_Pagination_Abstract);
          
          $iterator = $paginator->getIterator();
          $this->assertEquals("c1", $iterator->current()->va1);
          $this->assertEquals("c2", $iterator->current()->va2);
          $this->assertEquals("c3", $iterator->current()->va3);
          
          $iterator->next();
          $this->assertEquals("e1", $iterator->current()->va1);
          $this->assertEquals("e2", $iterator->current()->va2);
          $this->assertEquals("e3", $iterator->current()->va3);
      }
      
  }

