<?php

  /*
   * 
   */

  /**
   * Description of FactoryTest
   *
   * @author suleyman [at] melikoglu.info
   * @group grid
   */
  class FactoryTest extends BaseTestCase {

      public function testCreateArrayPaginator() {
          
          $datasource = new XGrid_DataSource_Array(array());
          
          $paginator = XGrid_Plugin_Pagination_Factory::create($datasource);
          
          $this->assertTrue($paginator instanceof XGrid_Plugin_Pagination_Abstract);
          $this->assertTrue($paginator instanceof XGrid_Plugin_Pagination_Array);
          
      }
      
  }
