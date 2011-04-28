<?php

  /*
   * 
   */

  /**
   * Description of FactoryTest
   *
   * @author suleymanmelikoglu [at] oyunstudyosu.com
   * @group grid
   */
  class FactoryTest extends BaseTestCase {

      public function testCreateArrayPaginator() {
          
          $datasource = new XGrid_DataSource_Array(array());
          
          $paginator = XGrid_Pagination_Factory::create($datasource);
          
          $this->assertTrue($paginator instanceof XGrid_Pagination_Abstract);
          $this->assertTrue($paginator instanceof XGrid_Pagination_Array);
          
      }
      
  }